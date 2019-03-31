<?
/*
$ch = curl_init('http://php.su');
curl_setopt  ($ch, CURLOPT_HEADER, true);
curl_exec($ch); // выполняем запрос curl - обращаемся к сервера php.su
curl_close($ch);
*/

/*
    $ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, "https://fapnem.com/chto-ya-sdelala");
//curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
$result = curl_exec ($ch);
curl_close($ch);
file_put_contents('fapnem.html', $result) ;
 */
/* начальная версия парсера */
$url='https://dro4lab.com/ukroshhenie-tima.html';
 $kolvo_page=12;//количество страниц
 $name_folder=substr($url, strrpos($url, '/')+1);

$refer='https://www.google.ru/';
$rezult=parsing($url,$refer);
//echo $rezult;
file_put_contents('pars_work/sem-soblazn.html', $rezult);

 require("lib/phpQuery-onefile.php");
$habrablog = file_get_contents('pars_work/sem-soblazn.html');
$doc = phpQuery::newDocument($habrablog);
$hentry = $doc->find('img.attachment-full');
 $kolvo=$hentry->size();
    for ($i=0; $i<$kolvo; $i++){
    $zx= $hentry->eq($i)->attr('src');
    	echo $zx."<br>";
    }
    $zx= $hentry->eq(0)->attr('src');
  
  $img_name=substr($zx,46,-5);
  echo "<br>".substr($zx, 0,-5);
  $url_base=substr($zx, 0,-5);
  $refer='https://dro4lab.com';
  $name_folder="pars_work/".$name_folder."/";
  mkdir($name_folder);

  
  for ($i=0; $i<=$kolvo_page;$i++){
     $url=$url_base.$i.".jpg";
  	$img=parsing($url,$refer);
  	if ($i+1<10) {$img_name_=$img_name."00";}
  	if ($i+1<100 && $i+1>9) {$img_name_=$img_name."0";}
  	if ($i+1>99) {$img_name_=$img_name;}
  	$my_work=$name_folder.$img_name_.($i+1).".jpg";
    file_put_contents($my_work, $img);
    echo $url."<br>";
  	//echo "<br>".$img_name_.$i.".jpg";

  }
  


  function parsing($url,$refer){
     
     $user_agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)";

//$cookie_file=$url;
$ch=curl_init($url);
 curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
 //curl_setopt($ch,CURLOPT_HEADER,true);
 //curl_setopt($ch, CURLOPT_NOBODY, true);
 curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
 curl_setopt($ch, CURLOPT_REFERER, $refer);
//curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
 //curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
 curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 $html=curl_exec($ch);
 curl_close($ch);
 //echo $html;
 //file_put_contents('pars_work/moana.html', $html);
 return $html;

  }  
?>