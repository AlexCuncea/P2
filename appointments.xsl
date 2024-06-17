<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:xlink="http://www.w3.org/1999/xlink">
    <xsl:template match="/">
        <html>
        <head>
            <title>Appointments</title>
            <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            <div class="container">
                <h2>Appointments</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Description</th>
                            <th>Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        <xsl:for-each select="appointments/appointment">
                            <tr>
                                <td><xsl:value-of select="user"/></td>
                                <td><xsl:value-of select="date"/></td>
                                <td><xsl:value-of select="time"/></td>
                                <td><xsl:value-of select="description"/></td>
                                <td><a href="{link/@xlink:href}" title="{link/@xlink:title}"><xsl:value-of select="link"/></a></td>
                            </tr>
                        </xsl:for-each>
                    </tbody>
                </table>
            </div>
        </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
