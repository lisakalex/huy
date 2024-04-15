<?php
include(__DIR__ . '/../a.php');

function monitor()
{
    $hit = 0;
    $monitor = "";
    $link = get_link();
    $sql = "SELECT `monitor` FROM monitor WHERE hit=? LIMIT 1";
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $hit);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $monitor);
        mysqli_stmt_fetch($stmt);
        mysqli_close($link);
    }

    $hit = 1;
    $link = get_link();
    $sql = "UPDATE monitor SET hit=? WHERE monitor=?";
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "is", $hit, $monitor);
        mysqli_stmt_execute($stmt);
        mysqli_close($link);
    }

    return $monitor;
}

//def __store_hyip(self, monitor, hyip, url, status):
//        cnx = mysql.connector.connect(host='localhost', user='root', passwd=None, database='tihuy')
//        cursor = cnx.cursor()
//
//        add_hyip = "INSERT INTO hyip (monitor, hyip, url, status) VALUES (%s, %s, %s, %s)"
//        data_hyip = (monitor, hyip, url, status)
//
//        cursor.execute(add_hyip, data_hyip)
//        emp_no = cursor.lastrowid
//        cnx.commit()
//        cursor.close()
//        cnx.close()

function __store_hyip($monitor, $hyip, $url, $status)
{
    $link = get_link();
    $sql = "INSERT INTO hyip (monitor, hyip, url, status) VALUES (?,?,?,?)";
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssi", $monitor, $hyip, $url, $status);
        mysqli_stmt_execute($stmt);
        mysqli_close($link);
    }
}

//
//    def __get_status(self, status):
//        s = 0
//        if status.lower().find("paying") != -1 and status.lower().find("not paying") == -1:
//            s = 1
//        return s

function __get_status($status)
{
    $s = 0;
    $status = strtolower($status);
    if ($status == "paying" && $status != "not paying") {
        $s = 1;
    }

    return $s;
}

function fairmonitor($monitor)
{
    $hyips = file_get_html($monitor);
//        bs = self.__source(monitor)
//        hyips = bs.findAll("table", {"class": "detn_stat1_block"})
//
//        for n in hyips:
//            hyip = n.find("a").get_text().capitalize()
//            url = n.find("a").attrs['href']
//            s = n.find("span").get_text()
//            status = self.__get_status(s)
//            self.__store_hyip(monitor, hyip, url, status)

    foreach ($hyips->find('table.detn_stat1_block') as $e) {
        $hyip = ucfirst(strtolower($e->find('a', 0)->plaintext));
        $url = $e->find('a', 0)->href;
        $s = $e->find('span span', 0)->plaintext;
        $status = __get_status($s);
        __store_hyip($monitor, $hyip, $url, $status);
    }

    $huy = null;

//    if (empty($curl['contents'])) {
//        return false;
//    }

//    $content = mb_convert_encoding($curl['contents'], 'HTML-ENTITIES', 'UTF-8');
//    $doc = new DOMDocument('1.0', 'utf-8');
//
//    $doc->loadHTML($content);
//    $hyips = array();
//    $hyips = $doc->getElementsByTagName("table");

//    $xpath = new DOMXPath($doc);
//    $hyips = $xpath->query("//div[@class='detn_whole_block']/div");
//
//    foreach ($hyips as $h) {
//        $links[] = array('url' => $link->getElementsByTagName('class'), 'text' => $link->nodeValue);
//        $links[] = $link->getElementsByTagName('class');
//        $links[] = $link->nodeValue;
//        $h1[] = $h->getAttribute('class');
//    }
//    $hyips = $doc->getElementsByTagName("*");
//    $huy = null;

}

function goldpoll()
{
    $monitor = "https://www.goldpoll.com";
    $curl = call_curl($monitor);
    $hyips = explode("<table class=", $curl['contents']);
    array_shift($hyips);

    foreach ($hyips as $h) {
        $status = 0;
        $exploded = explode("<a href=\"/out.php?p=", $h);
        $hyip = between(">", "<", $exploded[1]);
        $hyip = trim($hyip);

        $urll = before("\"", $exploded[1]);
        $urll = "https://www.goldpoll.com/out.php?p=" . $urll;

        $exploded = explode("<div class=\"status", $h);
        $stat = between(">", "<", $exploded[1]);

        if ($stat == "Paying") $status = 1;

        $link = get_link();
        $sql = "INSERT INTO hyip (monitor, url, hyip, status) VALUES(?,?,?,?)";
        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssi", $monitor, $urll, $hyip, $status);
            mysqli_stmt_execute($stmt);
            mysqli_close($link);
        }
    }
}

function list4hyip()
{
    $monitor = "https://www.list4hyip.com";
    $curl = call_curl($monitor);
    $exploded = explode("<a class=\"name\"", $curl['contents']);
    array_shift($exploded);

    foreach ($exploded as $h) {
        $status = 0;
        $urll = between("href=\"", "\"", $h);

        $hyip = between("<b>", "</b>", $h);

        if (found($h, "Paying")) $status = 1;

        $link = get_link();
        $sql = "INSERT INTO hyip (monitor, url, hyip, status) VALUES(?,?,?,?)";
        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssi", $monitor, $urll, $hyip, $status);
            mysqli_stmt_execute($stmt);
            mysqli_close($link);
        }
    }
}


//
//function fairmonitor($monitor)
//{
//    $curl = call_curl($monitor);
//
//    if (empty($curl['contents'])) {
//        return false;
//    }
//
//    $content = mb_convert_encoding($curl['contents'], 'HTML-ENTITIES', 'UTF-8');
//    $doc = new DOMDocument('1.0', 'utf-8');
//
//    $doc->loadHTML($content);
//    $hyips = array();
//    $hyips = $doc->getElementsByTagName("table");
//
////    $xpath = new DOMXPath($doc);
////    $hyips = $xpath->query("//div[@class='detn_whole_block']/div");
////
//    foreach ($hyips as $h) {
////        $links[] = array('url' => $link->getElementsByTagName('class'), 'text' => $link->nodeValue);
////        $links[] = $link->getElementsByTagName('class');
////        $links[] = $link->nodeValue;
//        $h1[] = $h->getAttribute('class');
//    }
////    $hyips = $doc->getElementsByTagName("*");
//    $huy = null;
//
//}

//    foreach ($exploded as $h) {
//        $status = 0;
//        $urll = between("href=\"", "\"", $h);
//
//        $hyip = between("<b>", "</b>", $h);
//
//        if(found($h, "Paying")) $status = 1;
//
//        $link = get_link();
//        $sql = "INSERT INTO hyip (monitor, url, hyip, status) VALUES(?,?,?,?)";
//        $stmt = mysqli_stmt_init($link);
//        if (mysqli_stmt_prepare($stmt, $sql)) {
//            mysqli_stmt_bind_param($stmt, "sssi", $monitor, $urll, $hyip, $status);
//            mysqli_stmt_execute($stmt);
//            mysqli_close($link);
//        }
//    }
//}
