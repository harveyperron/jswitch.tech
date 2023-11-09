<?php
if (isset($_GET['keywords'])) {
    $keywords = $_GET['keywords'];
    // Sanitize the input to prevent security issues like XSS
    $keywords = htmlspecialchars($keywords);
if (stripos($keywords, 'smart tv') !== false) {
    echo "
<iframe sandbox='allow-popups allow-scripts allow-modals allow-forms allow-same-origin' style='width:120px;height:240px;' marginwidth='0' marginheight='0' scrolling='no' frameborder='0' src='//rcm-na.amazon-adsystem.com/e/cm?lt1=_blank&bc1=000000&IS2=1&bg1=FFFFFF&fc1=000000&lc1=0000FF&t=jswitch20-20&language=fr_CA&o=15&p=8&l=as4&m=amazon&f=ifr&ref=as_ss_li_til&asins=B09N6XYRK7&linkId=e614d3d9b698d4a5ec657b4d08fd4b9a'></iframe>
<iframe sandbox='allow-popups allow-scripts allow-modals allow-forms allow-same-origin' style='width:120px;height:240px;' marginwidth='0' marginheight='0' scrolling='no' frameborder='0' src='//rcm-na.amazon-adsystem.com/e/cm?lt1=_blank&bc1=000000&IS2=1&bg1=FFFFFF&fc1=000000&lc1=0000FF&t=jswitch20-20&language=fr_CA&o=15&p=8&l=as4&m=amazon&f=ifr&ref=as_ss_li_til&asins=B09R8WTG8B&linkId=2b31c47ccd1a4afddd0eff1d061d2320'></iframe>
<iframe sandbox='allow-popups allow-scripts allow-modals allow-forms allow-same-origin' style='width:120px;height:240px;' marginwidth='0' marginheight='0' scrolling='no' frameborder='0' src='//rcm-na.amazon-adsystem.com/e/cm?lt1=_blank&bc1=000000&IS2=1&bg1=FFFFFF&fc1=000000&lc1=0000FF&t=jswitch20-20&language=fr_CA&o=15&p=8&l=as4&m=amazon&f=ifr&ref=as_ss_li_til&asins=B08NV4MWSS&linkId=5e5ac0b6b1f6c77423478cdde81d0794'></iframe>
";
} else if (stripos($keywords, 'laptop') !== false) {
    echo "
<iframe sandbox='allow-popups allow-scripts allow-modals allow-forms allow-same-origin' style='width:120px;height:240px;' marginwidth='0' marginheight='0' scrolling='no' frameborder='0' src='//rcm-na.amazon-adsystem.com/e/cm?lt1=_blank&bc1=000000&IS2=1&bg1=FFFFFF&fc1=000000&lc1=0000FF&t=jswitch20-20&language=fr_CA&o=15&p=8&l=as4&m=amazon&f=ifr&ref=as_ss_li_til&asins=B08T6J8MZK&linkId=bb385859412de93cf04481f6d130a889'></iframe>
<iframe sandbox='allow-popups allow-scripts allow-modals allow-forms allow-same-origin' style='width:120px;height:240px;' marginwidth='0' marginheight='0' scrolling='no' frameborder='0' src='//rcm-na.amazon-adsystem.com/e/cm?lt1=_blank&bc1=000000&IS2=1&bg1=FFFFFF&fc1=000000&lc1=0000FF&t=jswitch20-20&language=fr_CA&o=15&p=8&l=as4&m=amazon&f=ifr&ref=as_ss_li_til&asins=B0BWMRFYG5&linkId=125e6748d6418e74754d0170b4021313'></iframe>
<iframe sandbox='allow-popups allow-scripts allow-modals allow-forms allow-same-origin' style='width:120px;height:240px;' marginwidth='0' marginheight='0' scrolling='no' frameborder='0' src='//rcm-na.amazon-adsystem.com/e/cm?lt1=_blank&bc1=000000&IS2=1&bg1=FFFFFF&fc1=000000&lc1=0000FF&t=jswitch20-20&language=fr_CA&o=15&p=8&l=as4&m=amazon&f=ifr&ref=as_ss_li_til&asins=B0CBSNR1GZ&linkId=7d0f347ccad14a9609ee5d623835f069'></iframe>
<iframe sandbox='allow-popups allow-scripts allow-modals allow-forms allow-same-origin' style='width:120px;height:240px;' marginwidth='0' marginheight='0' scrolling='no' frameborder='0' src='//rcm-na.amazon-adsystem.com/e/cm?lt1=_blank&bc1=000000&IS2=1&bg1=FFFFFF&fc1=000000&lc1=0000FF&t=jswitch20-20&language=fr_CA&o=15&p=8&l=as4&m=amazon&f=ifr&ref=as_ss_li_til&asins=B0B42D79VN&linkId=086bfcdcc38ff8e5fc7b3099d8d273e6'></iframe>
<iframe sandbox='allow-popups allow-scripts allow-modals allow-forms allow-same-origin' style='width:120px;height:240px;' marginwidth='0' marginheight='0' scrolling='no' frameborder='0' src='//rcm-na.amazon-adsystem.com/e/cm?lt1=_blank&bc1=000000&IS2=1&bg1=FFFFFF&fc1=000000&lc1=0000FF&t=jswitch20-20&language=fr_CA&o=15&p=8&l=as4&m=amazon&f=ifr&ref=as_ss_li_til&asins=B098R9BRWC&linkId=daee2c031f0c04c145a444c080d5fbb4'></iframe>
	";
} else if (stripos($keywords, 'chromebook') !== false) {
    echo "
<iframe sandbox='allow-popups allow-scripts allow-modals allow-forms allow-same-origin' style='width:120px;height:240px;' marginwidth='0' marginheight='0' scrolling='no' frameborder='0' src='//rcm-na.amazon-adsystem.com/e/cm?lt1=_blank&bc1=000000&IS2=1&bg1=FFFFFF&fc1=000000&lc1=0000FF&t=jswitch20-20&language=fr_CA&o=15&p=8&l=as4&m=amazon&f=ifr&ref=as_ss_li_til&asins=B0BNSSG3XS&linkId=e74fc8160677d02ea0aa78f96969c21c'></iframe>
	";
} else if (stripos($keywords, 'phone') !== false) {
    echo "
<iframe sandbox='allow-popups allow-scripts allow-modals allow-forms allow-same-origin' style='width:120px;height:240px;' marginwidth='0' marginheight='0' scrolling='no' frameborder='0' src='//rcm-na.amazon-adsystem.com/e/cm?lt1=_blank&bc1=000000&IS2=1&bg1=FFFFFF&fc1=000000&lc1=0000FF&t=jswitch20-20&language=fr_CA&o=15&p=8&l=as4&m=amazon&f=ifr&ref=as_ss_li_til&asins=B099X93JZH&linkId=4a4c216a3cc5f03673e9f63fef38c876'></iframe>
<iframe sandbox='allow-popups allow-scripts allow-modals allow-forms allow-same-origin' style='width:120px;height:240px;' marginwidth='0' marginheight='0' scrolling='no' frameborder='0' src='//rcm-na.amazon-adsystem.com/e/cm?lt1=_blank&bc1=000000&IS2=1&bg1=FFFFFF&fc1=000000&lc1=0000FF&t=jswitch20-20&language=fr_CA&o=15&p=8&l=as4&m=amazon&f=ifr&ref=as_ss_li_til&asins=B01CR2ADEG&linkId=2f15d6e55952702437964e62df3c0b4f'></iframe>
<iframe sandbox='allow-popups allow-scripts allow-modals allow-forms allow-same-origin' style='width:120px;height:240px;' marginwidth='0' marginheight='0' scrolling='no' frameborder='0' src='//rcm-na.amazon-adsystem.com/e/cm?lt1=_blank&bc1=000000&IS2=1&bg1=FFFFFF&fc1=000000&lc1=0000FF&t=jswitch20-20&language=fr_CA&o=15&p=8&l=as4&m=amazon&f=ifr&ref=as_ss_li_til&asins=B0775717ZP&linkId=e79440e24544a6727c72ab2118e152a0'></iframe>
<iframe sandbox='allow-popups allow-scripts allow-modals allow-forms allow-same-origin' style='width:120px;height:240px;' marginwidth='0' marginheight='0' scrolling='no' frameborder='0' src='//rcm-na.amazon-adsystem.com/e/cm?lt1=_blank&bc1=000000&IS2=1&bg1=FFFFFF&fc1=000000&lc1=0000FF&t=jswitch20-20&language=fr_CA&o=15&p=8&l=as4&m=amazon&f=ifr&ref=as_ss_li_til&asins=B08PNM1LNZ&linkId=106085352e83c26492812733f881e6cc'></iframe>
<iframe sandbox='allow-popups allow-scripts allow-modals allow-forms allow-same-origin' style='width:120px;height:240px;' marginwidth='0' marginheight='0' scrolling='no' frameborder='0' src='//rcm-na.amazon-adsystem.com/e/cm?lt1=_blank&bc1=000000&IS2=1&bg1=FFFFFF&fc1=000000&lc1=0000FF&t=jswitch20-20&language=fr_CA&o=15&p=8&l=as4&m=amazon&f=ifr&ref=as_ss_li_til&asins=B083G849RZ&linkId=9d290e2c290c0028c2caa81a15de3031'></iframe>
<iframe sandbox='allow-popups allow-scripts allow-modals allow-forms allow-same-origin' style='width:120px;height:240px;' marginwidth='0' marginheight='0' scrolling='no' frameborder='0' src='//rcm-na.amazon-adsystem.com/e/cm?lt1=_blank&bc1=000000&IS2=1&bg1=FFFFFF&fc1=000000&lc1=0000FF&t=jswitch20-20&language=fr_CA&o=15&p=8&l=as4&m=amazon&f=ifr&ref=as_ss_li_til&asins=B0C3QSZC8S&linkId=ba3a442241f96db4bfd14f8d478c4c68'></iframe>
<iframe sandbox='allow-popups allow-scripts allow-modals allow-forms allow-same-origin' style='width:120px;height:240px;' marginwidth='0' marginheight='0' scrolling='no' frameborder='0' src='//rcm-na.amazon-adsystem.com/e/cm?lt1=_blank&bc1=000000&IS2=1&bg1=FFFFFF&fc1=000000&lc1=0000FF&t=jswitch20-20&language=fr_CA&o=15&p=8&l=as4&m=amazon&f=ifr&ref=as_ss_li_til&asins=B08SJ7M48G&linkId=4161791b21b155e6d87eb9056202e402'></iframe>
";
}
}
?>

