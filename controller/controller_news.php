<?php

if(!isset($_POST['newsUrl']))
{
    echo "<center><b>There are no feeds </b></center>";
    return false ;
}
    
 $xml=($_POST['newsUrl']);
 
                         
                             $xmlDoc = new DOMDocument();
                            $xmlDoc->load($xml);
                            $xmlDoc = new DOMDocument();
                                $xmlDoc->load($xml);

                                //get elements from "<channel>"
                                $channel=$xmlDoc->getElementsByTagName('channel')->item(0);
                                $channel_title = $channel->getElementsByTagName('title')
                                ->item(0)->childNodes->item(0)->nodeValue;
                                $channel_link = $channel->getElementsByTagName('link')
                                ->item(0)->childNodes->item(0)->nodeValue;
                                $channel_desc = $channel->getElementsByTagName('description')
                                ->item(0)->childNodes->item(0)->nodeValue;

                                //output elements from "<channel>"
                               /* echo("<p><a href='" . $channel_link
                                  . "'>" . $channel_title . "</a>");
                                echo("<br>");
                                echo($channel_desc . "</p>");
                                        */
                                //get and output "<item>" elements
                                $x=$xmlDoc->getElementsByTagName('item');
                                for ($i=0; $i<=12; $i++) {
                                  $item_title=$x->item($i)->getElementsByTagName('title')
                                  ->item(0)->childNodes->item(0)->nodeValue;
                                  $item_link=$x->item($i)->getElementsByTagName('link')
                                  ->item(0)->childNodes->item(0)->nodeValue;
                                  $item_desc=$x->item($i)->getElementsByTagName('description')
                                  ->item(0)->childNodes->item(0)->nodeValue;
                                  ?>
                                  <li>
                                      <?php
                                            echo ("<p><a href='" . $item_link
                                            . "'>" . $item_title . "</a>");
                                            echo ("<br>");
                                            echo ($item_desc . "</p>");
                                    ?>
                                  </li>
                                  <?php
                                  
                                }

                        ?>
 