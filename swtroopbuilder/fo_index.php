<?php
    include 'data.php';

    $troop_name = $_REQUEST['troop_name'];
    $count = $_REQUEST['count'];
    $cost = $_REQUEST['cost'];
    $size = $_REQUEST['size'];
    $agility = $dice[ $_REQUEST['agility']];
    $smarts = $dice[ $_REQUEST['smarts']];
    $spirit = $dice[ $_REQUEST['spirit']];
    $strength = $dice[ $_REQUEST['strength']];
    $vigor = $dice[ $_REQUEST['vigor']];
    $totalCost = $count*$cost;
    $parryBns = 0;
    $armorBns = 0;
    foreach( $armorBnsList as $key => $val ){ 
        if( $_POST[$key] )
            $armorBns += $val;
    }
    if( $_POST['other_armor_bonus'] ){
        $armorBns += $_POST['other_armor_bonus'];
    }
    foreach( $parryBnsList as $key => $val ){ 
        if( $_POST[$key] ){
            $parryBns += $val;
        }
    }
    if( $_POST['other_parry_bonus'] ){
        $parryBns += $_POST['other_parry_bonus'];
    }
    $toughnessBns = 0;
    foreach( $toughnessBnsList as $key => $val ){ 
        if( $_POST[$key] ){
            $toughnessBns += $val;
        }
    }
    if( $_POST['other_toughness_bonus'] ){
        $toughnessBns += $_POST['other_toughness_bonus'];
    }
    print '<?xml version="1.0" encoding="utf-8"?>';
?>

<!--
This game references the Savage Worlds game system, available from Pinnacle Entertainment Group at www.peginc.com. Savage Worlds and all associated logos and trademarks are copyrights of Pinnacle Entertainment Group. Used with permission. Pinnacle makes no representation or warranty as to the quality, viability, or suitability for purpose of this product.
-->

<fo:root xmlns:fox="http://xmlgraphics.apache.org/fop/extensions" xmlns:cms="http://www.pulitzer.ch/2007/CMSFormat"
         xmlns:fo="http://www.w3.org/1999/XSL/Format" xmlns:svg="http://www.w3.org/2000/svg">
    <cms:pager printer_format="ThreeByFive" build="9/10/08 10:45 PM" editor="FOP converter to QT-TextDocument"/>
    <fo:layout-master-set>
        <fo:simple-page-master master-name="ThreeByFive" page-width="5in" page-height="3in"
                               margin-bottom="5pt" margin-left="5pt" margin-top="5pt" margin-right="5pt">
            <fo:region-body margin-left="5pt" background-color="#ffffff" margin-bottom="5pt"
                            region-name="xsl-region-body" margin-top="5pt" margin-right="5pt"/>
        </fo:simple-page-master>
    </fo:layout-master-set>

    <fo:page-sequence master-reference="ThreeByFive">

        <fo:flow flow-name="xsl-region-body">
          <fo:table>
            <fo:table-column column-width="2in"/>
            <fo:table-column column-width="2in"/>
            <fo:table-column column-width="1in"/>
            <fo:table-body>
              <fo:table-row>
                <fo:table-cell>
                  <fo:block font-family="Arial" text-align="left" color="#000000"
                          font-size="10pt" font-weight="bold"
                          >Name: <?= $troop_name ?>  <?= ($count>0)?"({$count})":"" ?>
                          <?= $_POST['wildcard']?'<fo:inline color="#FF0000" >WC</fo:inline>':''?>
                          </fo:block>
                  <fo:block font-family="Arial" text-align="left" color="#000000"
                          font-size="8pt" font-weight="bold"
                          >Cost: <?= $cost ?><?= ($count>0)?"x{$count} = {$totalCost}":"" ?></fo:block>
                </fo:table-cell>
                <fo:table-cell>
                  <fo:table>
                    <fo:table-column column-width=".6in"/>
                    <fo:table-column column-width=".3in"/>
                    <fo:table-column column-width=".6in"/>
                    <fo:table-column column-width=".3in"/>
                    <fo:table-body >

                      <fo:table-row>
                        <fo:table-cell>
                          <fo:block font-family="Arial" text-align="right" color="#000000"
                              font-size="8pt" font-weight="bold" margin-left="2px" >
                                Agility: </fo:block></fo:table-cell>
                        <fo:table-cell>
                          <fo:block font-family="Arial" text-align="left" color="#000000"
                              font-size="8pt" font-weight="bold" margin-left="2px" >
                                <?= $agility ?></fo:block></fo:table-cell>
                        <fo:table-cell>
                          <fo:block font-family="Arial" text-align="right" color="#000000"
                              font-size="8pt" font-weight="bold" margin-left="2px" >
                                Parry: </fo:block></fo:table-cell>
                        <fo:table-cell>
                          <fo:block font-family="Arial" text-align="left" color="#000000"
                              font-size="8pt" font-weight="bold" margin-left="2px" >
<?= $_POST['fighting']?(($_POST['fighting']/2)+3+$parryBns):"2" ?> <?= $parryBns?"({$parryBns})":""; ?>
                                </fo:block></fo:table-cell>
                      </fo:table-row>


                      <fo:table-row>
                        <fo:table-cell>
                          <fo:block font-family="Arial" text-align="right" color="#000000"
                              font-size="8pt" font-weight="bold" margin-left="2px" >
                                Smarts: </fo:block></fo:table-cell>
                        <fo:table-cell>
                          <fo:block font-family="Arial" text-align="left" color="#000000"
                              font-size="8pt" font-weight="bold" margin-left="2px" >
                                <?= $smarts ?></fo:block></fo:table-cell>
                        <fo:table-cell>
                          <fo:block font-family="Arial" text-align="right" color="#000000"
                              font-size="8pt" font-weight="bold" margin-left="2px" >
                                Toughness: </fo:block></fo:table-cell>
                        <fo:table-cell>
                          <fo:block font-family="Arial" text-align="left" color="#000000"
                              font-size="8pt" font-weight="bold" margin-left="2px" >
<?= ($_POST['vigor']+$_POST['size'])+3+$armorBns+$toughnessBns ?> <?= $armorBns?"({$armorBns})":""; ?> 
                                </fo:block></fo:table-cell>
                      </fo:table-row>


                      <fo:table-row>
                        <fo:table-cell>
                          <fo:block font-family="Arial" text-align="right" color="#000000"
                              font-size="8pt" font-weight="bold" margin-left="2px" >
                                Spirit: </fo:block></fo:table-cell>
                        <fo:table-cell>
                          <fo:block font-family="Arial" text-align="left" color="#000000"
                              font-size="8pt" font-weight="bold" margin-left="2px" >
                                <?= $spirit ?></fo:block></fo:table-cell>
<?php if( $size != 0 ){?>
                        <fo:table-cell>
                          <fo:block font-family="Arial" text-align="right" color="#000000"
                              font-size="8pt" font-weight="bold" margin-left="2px" >
                                Size: </fo:block></fo:table-cell>
                        <fo:table-cell>
                          <fo:block font-family="Arial" text-align="left" color="#000000"
                              font-size="8pt" font-weight="bold" margin-left="2px" >
<?php if( $size > 0 ){?>
                                +<?= $_POST['size'] ?>
<?php } else if( $size < 0 ){?>
                                <?= $_POST['size'] ?>
<?php } ?>
                                </fo:block>
                                </fo:table-cell>
<?php } ?>
                      </fo:table-row>


                      <fo:table-row>
                        <fo:table-cell>
                          <fo:block font-family="Arial" text-align="right" color="#000000"
                              font-size="8pt" font-weight="bold" margin-left="2px" >
                                Strength: </fo:block></fo:table-cell>
                        <fo:table-cell>
                          <fo:block font-family="Arial" text-align="left" color="#000000"
                              font-size="8pt" font-weight="bold" margin-left="2px" >
                                <?= $strength ?></fo:block></fo:table-cell>

                        <fo:table-cell>
                          <fo:block font-family="Arial" text-align="right" color="#000000"
                              font-size="8pt" font-weight="bold" margin-left="2px" >
                                Vigor: </fo:block></fo:table-cell>
                        <fo:table-cell>
                          <fo:block font-family="Arial" text-align="left" color="#000000"
                              font-size="8pt" font-weight="bold" margin-left="2px" >
                                <?= $vigor ?></fo:block></fo:table-cell>
                      </fo:table-row>

                    </fo:table-body>
                  </fo:table>
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
<!--
          <fo:table>
<?php foreach( $attributes  as $att ) { ?>
            <fo:table-column column-width="0.8in"/>
<?php } ?>
            <fo:table-body>
              <fo:table-row>
<?php foreach( $attributes  as $att ) { ?>
                <fo:table-cell>
                  <fo:block font-family="Arial" text-align="left" color="#000000"
                          font-size="8pt" font-weight="bold"
                          ><?= ucfirst($att).": ".$dice[$_REQUEST[$att]] ?></fo:block>
                </fo:table-cell>
<?php } ?>
              </fo:table-row>
            </fo:table-body>
          </fo:table>
-->

          <fo:table >
            <fo:table-column column-width="1in"/>
            <fo:table-column column-width="2.75in"/>
            <fo:table-column column-width="1in"/>
            <fo:table-body>
              <fo:table-row height="1.2in">
                <fo:table-cell padding="2px"
                          border-width="1pt" border-color="#000000" border-style="solid"
                >
                  <fo:block font-family="Arial" text-align="left" color="#000000"
                          font-size="6pt" font-weight="bold"
                          border-width="1pt" border-color="#000000" border-bottom-style="ridge"
                          >
                          SKILLS
                  </fo:block>
                  <fo:list-block font-family="Arial" text-align="right" color="#000000"
                          font-size="8pt" font-weight="plain"
                  >
<?php foreach( $skills as $att => $value ){ ?>
<?php if($dice[$_POST[$att]/$skills[$att]]){ ?>
                    <fo:list-item>
                      <fo:list-item-label>
                        <fo:block></fo:block>
                      </fo:list-item-label>
                      <fo:list-item-body>
                        <fo:block><?=  ucwords( $att )  ?>: <?= $dice[$_POST[$att]/$skills[$att]] ?></fo:block>
                      </fo:list-item-body>
                    </fo:list-item>
<?php } ?>
<?php } ?>
                  </fo:list-block>
                </fo:table-cell>
                <fo:table-cell
                          border-width="1pt" border-color="#000000" border-style="solid"
                          padding="2px"
                >
                  <fo:block font-family="Arial" text-align="left" color="#000000"
                          font-size="6pt" font-weight="bold"
                          border-width="1pt" border-color="#000000" border-bottom-style="ridge"
                          >
                          EDGES / HINDRANCES / SPECIAL ABILITIES
                  </fo:block>

<?php foreach( $edges as $att => $value ){ ?>
<?php if($_POST[$att]){ ?>
                  <fo:block font-family="Arial" text-align="left" color="#000000" font-size="8pt" >
* <?=  ucwords( str_replace( "_", " ", $att ) ) ?>
                  </fo:block>
<?php } ?>
<?php } ?>
<?php foreach( $hindrances as $att => $value ){ ?>
<?php if($_POST[$att]){ ?>
                  <fo:block font-family="Arial" text-align="left" color="#000000" font-size="8pt" >
* <?=  ucwords( str_replace( "_", " ", $att ) ) ?>
                  </fo:block>
<?php } ?>
<?php } ?>
<?php foreach( $special_abilities as $att => $value ){ ?>
<?php if($_POST[$att]){ ?>
                  <fo:block font-family="Arial" text-align="left" color="#000000" font-size="8pt" >
* <?=  ucwords( str_replace( "_", " ", $att ) ) ?>
                  </fo:block>
<?php } ?>
<?php } ?>
<?php if($_POST['special_ability_description']){ 
    $parts = explode("[BR]", $_POST['special_ability_description'] );
    foreach( $parts as $part ) {
    ?>
                  <fo:block font-family="Arial" text-align="left" color="#000000" font-size="8pt" >
* <?=  $part ?>
                  </fo:block>
<?php } } ?>

                </fo:table-cell>
                <fo:table-cell 
                          border-width="1pt" border-color="#000000" border-style="solid"
                          padding="2px"
                >
                  <fo:block font-family="Arial" text-align="center" color="#000000"
                          font-size="6pt" font-weight="bold"
                          border-width="1pt" border-color="#000000" border-bottom-style="ridge"
                          >
<?php if( $_POST['wildcard'] ){ ?>
WOUNDS
<?php $items = array( "-1", "-2", "-3", "Incap."); ?>
<?php }else{ ?>
AMMO
<?php $items = array( "V. High", "High", "Low", "Out"); ?>
<?php } ?>
                  </fo:block>
<?php foreach( $items as $item ) { ?>
                  <fo:block font-family="Courier" text-align="right" color="#000000"
                          font-size="10pt"
                          ><?= $item ?> [ ]
                  </fo:block>
<?php } ?>
                </fo:table-cell>
              </fo:table-row>
            </fo:table-body>
          </fo:table>



            <fo:block-container width="100%" margin-left="0pt" height="0.5in"
                                absolute-position="absolute"
                                background-color="#ffffff" left="0pt" margin-bottom="0pt"
                                border-width="1pt" border-color="#000000" border-style="solid"
                                margin-top="0pt" margin-right="0pt" top="1.8in" bottom="0pt">
                <fo:block font-family="Arial" text-align="left" color="#000000" font-size="6pt" font-weight="bold"
                                border-width="1pt" border-color="#000000" border-bottom-style="solid"
                                width="0.5in"
                                padding="2px"
                  >EQUIPMENT
                </fo:block>
                <fo:block font-family="Arial" text-align="left" color="#000000" font-size="8pt" 
                                padding="2px" >
<?php foreach( $armorList as $att => $value ){ ?>
<?php if($_POST[$att]){ ?>
<?=  $equipmentDescrList[$att]?$equipmentDescrList[$att]:ucwords( str_replace( "_", " ", $att ) ) ; ?>,
<?php } ?>
<?php } ?>
<?php foreach( $handWpnList as $att => $value ){ ?>
<?php if($_POST[$att]){ ?>
<?=  $equipmentDescrList[$att]?$equipmentDescrList[$att]:ucwords( str_replace( "_", " ", $att ) ) ; ?>,
<?php } ?>
<?php } ?>
<?php foreach( $rangedWpnList as $att => $value ){ ?>
<?php if($_POST[$att]){ ?>
<?=  $equipmentDescrList[$att]?$equipmentDescrList[$att]:ucwords( str_replace( "_", " ", $att ) ) ; ?>,
<?php } ?>
<?php } ?>
<?php if($_POST['special_equipment_description']){ ?>
<?=  $_POST['special_equipment_description']?>
<?php } ?>
                </fo:block>

            </fo:block-container>

            <fo:block-container width="100%" margin-left="0pt" z-index="13.333"
                                absolute-position="absolute" height="auto"
                                background-color="#eeeeee" left="0pt" margin-bottom="0pt"
                                margin-top="0pt" margin-right="0pt" top="2.35in" bottom="0pt">
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
