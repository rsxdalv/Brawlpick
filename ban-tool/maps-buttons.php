<?php

echo "Your turn to ban <br>";

if ($blackguard==0)
{
    echo "<div id=\"blackguard\"><img src=\"pic/blackguard.jpg\" onclick='dostuffandthings(\"blackguard\")'></div>" ;
}
else {echo "<div id=\"blackguard\"><img src=\"pic/blackguardban.jpg\"></div>";}

if ($kings==0)
{
    echo "<div id=\"kings\"><img src=\"pic/kings.jpg\" onclick='dostuffandthings(\"kings\")'></div>" ;
}
else {echo "<div id=\"kings\"><img src=\"pic/kingsban.jpg\"></div>";}

if ($mammoth==0)
{
    echo "<div id=\"mammoth\"><img src=\"pic/mammoth.jpg\" onclick='dostuffandthings(\"mammoth\")'></div>" ;
}
else {echo "<div id=\"mammoth\"><img src=\"pic/mammothban.jpg\"></div>";}

if ($shipwreck==0)
{
    echo "<div id=\"shipwreck\"><img src=\"pic/shipwreck.jpg\" onclick='dostuffandthings(\"shipwreck\")'></div>" ;
}
else {echo "<div id=\"shipwreck\"><img src=\"pic/shipwreckban.jpg\"></div>";}

if ($shithall==0)
{
    echo "<div id=\"shithall\"><img src=\"pic/shithall.jpg\" onclick='dostuffandthings(\"shithall\")'></div>" ;
}
else {echo "<div id=\"shithall\"><img src=\"pic/shithallban.jpg\"></div>";}

if ($stadium==0)
{
    echo "<div id=\"stadium\"><img src=\"pic/stadium.jpg\" onclick='dostuffandthings(\"stadium\")'></div>" ;
}
else {echo "<div id=\"stadium\"><img src=\"pic/stadiumban.jpg\"></div>";}

if ($twillight==0)
{
    echo "<div id=\"twillight\"><img src=\"pic/twillight.jpg\" onclick='dostuffandthings(\"twillight\")'></div>" ;
}
else {echo "<div id=\"twillight\"><img src=\"pic/twillightban.jpg\"></div>";}
