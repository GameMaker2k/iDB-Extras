<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
 <html xsl:version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/1999/xhtml">
  <body style="font-family:Arial;font-size:12pt;background-color:#EEEEEE">
   <xsl:for-each select="versioninfo/version">
    <div style="background-color:teal;color:white;padding:4px">
     <span style="font-weight:bold"><xsl:value-of select="fullrel"/></span>
    </div>
    <div style="margin-left:20px;margin-bottom:1em;font-size:10pt">
     <span style="font-style:italic"><xsl:value-of select="fullname"/></span>
    </div>
   </xsl:for-each>
  </body>
 </html>
</xsl:template>

</xsl:stylesheet>
