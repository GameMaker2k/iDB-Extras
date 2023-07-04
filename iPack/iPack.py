import os
import gzip
import bz2
import base64
import hashlib

def file_list_dir(dirname):
    srcdir = []
    srcfile = []
    for root, dirs, files in os.walk(dirname):
        for file in files:
            srcfile.append(file)
        for dir in dirs:
            srcdir.append(dir)
    srcdir.sort()
    srcfile.sort()
    fulllist = srcdir + srcfile
    return fulllist

def gzip_file(infile, outfile, param=5):
    with open(infile, 'rb') as f_in, gzip.open(outfile, 'wb', compresslevel=param) as f_out:
        f_out.writelines(f_in)

def bzip_file(infile, outfile):
    with open(infile, 'rb') as f_in, bz2.open(outfile, 'wb') as f_out:
        f_out.writelines(f_in)

def make_ipack_1(packname, ziptype, delunzip, encodetype, decodetype):
    if packname is None or encodetype is None or decodetype is None:
        return False
    fal = file_list_dir(packname)
    num = len(fal) - 1
    i = 0
    with open(f"{packname}.py", "w+") as fp:
        filecont = ''
        while i <= num:
            with open(f"{packname}/{fal[i]}", "rb") as file:
                falc = file.read()
            if encodetype == "base64_encode":
                falc = base64.b64encode(falc).decode()
            if decodetype == "base64_decode":
                falc = base64.b64decode(falc).decode()
            filecont += f'filename["{i}"] = "{fal[i]}"\n'
            filecont += f'filecont["{i}"] = "{falc}"\n'
            filecont += f'filemd5["{i}"] = "{hashlib.md5(falc.encode()).hexdigest()}"\n'
            filecont += f'filesha1["{i}"] = "{hashlib.sha1(falc.encode()).hexdigest()}"\n'
            i += 1
        fp.write(filecont)
    if ziptype == "gzip":
        gzip_file(f"{packname}.py", f"{packname}.py.gz")
    if ziptype == "bzip2":
        bzip_file(f"{packname}.py", f"{packname}.py.bz2")
    if delunzip:
        os.remove(f"{packname}.py")
    return True

# You can call the function like this:
# make_ipack_1("iDB", "gzip&bzip2", False, "base64_encode", "base64_decode")
