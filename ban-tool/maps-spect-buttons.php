<?php

if ($step == 1 OR $step == 4 OR $step == 5) {echo "Player 1 is banning now<br />";}
if ($step == 2 OR $step == 3 OR $step == 6) {echo "Player 2 is banning now<br />";}
if ($step == 7) {echo "Bans complete<br />";}


if ($blackguard == 0)
{
    echo "<div id=\"blackguard\"><img src=\"pic/blackguard.jpg\"></div>" ;
}
else {echo "<div id=\"blackguard\"><img src=\"pic/blackguardban.jpg\"></div>";}

if ($kings == 0)
{
    echo "<div id=\"kings\"><img src=\"pic/kings.jpg\"></div>" ;
}
else {echo "<div id=\"kings\"><img src=\"pic/kingsban.jpg\"></div>";}

if ($mammoth == 0)
{
    echo "<div id=\"mammoth\"><img src=\"pic/mammoth.jpg\"></div>" ;
}
else {echo "<div id=\"mammoth\"><img src=\"pic/mammothban.jpg\"></div>";}

if ($shipwreck == 0)
{
    echo "<div id=\"shipwreck\"><img src=\"pic/shipwreck.jpg\"></div>" ;
}
else {echo "<div id=\"shipwreck\"><img src=\"pic/shipwreckban.jpg\"></div>";}

if ($shithall == 0)
{
    echo "<div id=\"shithall\"><img src=\"pic/shithall.jpg\"></div>" ;
}
else {echo "<div id=\"shithall\"><img src=\"pic/shithallban.jpg\"></div>";}

if ($stadium == 0)
{
    echo "<div id=\"stadium\"><img src=\"pic/stadium.jpg\"></div>" ;
}
else {echo "<div id=\"stadium\"><img src=\"pic/stadiumban.jpg\"></div>";}

if ($twillight == 0)
{
    echo "<div id=\"twillight\"><img src=\"pic/twillight.jpg\"></div>" ;
}
else {echo "<div id=\"twillight\"><img src=\"pic/twillightban.jpg\"></div>";}
