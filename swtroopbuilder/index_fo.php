<?xml version="1.0" encoding="utf-8"?>
<!--
This game references the Savage Worlds game system, available from Pinnacle Entertainment Group at www.peginc.com. Savage Worlds and all associated logos and trademarks are copyrights of Pinnacle Entertainment Group. Used with permission. Pinnacle makes no representation or warranty as to the quality, viability, or suitability for purpose of this product.
-->

<fo:root xmlns:fox="http://xmlgraphics.apache.org/fop/extensions" xmlns:cms="http://www.pulitzer.ch/2007/CMSFormat"
         xmlns:fo="http://www.w3.org/1999/XSL/Format" xmlns:svg="http://www.w3.org/2000/svg">
    <cms:pager printer_format="US-Letter" build="9/10/08 10:45 PM" editor="FOP converter to QT-TextDocument"/>
    <fo:layout-master-set>
        <fo:simple-page-master master-name="US-Letter" page-width="5in" page-height="3in"
                               margin-bottom="5pt" margin-left="5pt" margin-top="5pt" margin-right="5pt">
            <fo:region-body margin-left="5pt" background-color="#ffffff" margin-bottom="5pt"
                            region-name="xsl-region-body" margin-top="5pt" margin-right="5pt"/>
        </fo:simple-page-master>
    </fo:layout-master-set>

    <fo:page-sequence master-reference="US-Letter">

        <fo:flow flow-name="xsl-region-body">
          <fo:table>
            <fo:table-column column-width="4in"/>
            <fo:table-column column-width="1in"/>
            <fo:table-body>
              <fo:table-row>
                <fo:table-cell>
                  <fo:block font-family="Arial" text-align="left" color="#000000"
                          font-size="10pt" font-weight="bold"
                          >Name: __troop_name__  (__count__)</fo:block>
                  <fo:block font-family="Arial" text-align="left" color="#000000"
                          font-size="8pt" font-weight="bold"
                          >Agil: __agility__  Smarts: __smarts__  Spirit: __spirit__  Strength: __strength__  Vigor: __vigor__</fo:block>
                </fo:table-cell>
                <fo:table-cell>
                  <fo:block font-family="Arial" text-align="left" color="#000000"
                          font-size="8pt" font-weight="italic">
                         <fo:external-graphic height="25px" width="39px" src="SW_Fan.png" />
                  </fo:block>
                </fo:table-cell>
              </fo:table-row>
            </fo:table-body>
          </fo:table>



            <!-- Header Block -->
<!--
            <fo:block-container width="100%" margin-left="0pt" z-index="13.333"
                                absolute-position="absolute" height="25pt"
                                background-color="#ffffff" left="0pt" margin-bottom="0pt"
                                border-width="1mm"
                                margin-top="0pt" margin-right="0pt" top="0pt">
                <fo:block font-family="Arial" text-align="left" color="#000000"
                          absolute-position="absolute" top="0pt"
                          border-width="1mm"
                          font-size="10pt" width="3in">
                          Name: __troop_name__
                </fo:block>
                <fo:block font-family="Arial" text-align="right" color="#000000"
                          absolute-position="absolute" top="0pt"
                          border-width="1mm"
                          font-size="10pt" width="2in">
                    <fo:external-graphic height="25px" width="39px"
                                         src="SW_Fan.png" />
                <fo:block font-family="Arial" text-align="right" color="#000000"
                          font-size="8pt" font-weight="italic">&#169;2009 frohlich.net
                </fo:block>
                </fo:block>
            </fo:block-container>
-->
            <fo:block-container width="100%" margin-left="0pt" z-index="13.333"
                                absolute-position="absolute" height="auto"
                                background-color="#ffffff" left="0pt" margin-bottom="0pt"
                                margin-top="0pt" margin-right="0pt" top="2.5in" bottom="0pt">
                <fo:block font-family="Arial" text-align="left" color="#000000" font-size="6pt"
                        >This game references the Savage Worlds game system, available from Pinnacle
                    Entertainment Group at www.peginc.com. Savage Worlds and all associated logos and
                    trademarks are copyrights of Pinnacle Entertainment Group. Used with permission.
                    Pinnacle makes no representation or warranty as to the quality, viability, or
                    suitability for purpose of this product.
                </fo:block>
            </fo:block-container>

        </fo:flow>
    </fo:page-sequence>
</fo:root>
