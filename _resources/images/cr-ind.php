<?php
/**
 * Add index.html file to all dir recursively starting from<br/>
 * give dir, this is extremely helpful when you want to<br/>
 * prevent directory indexing and don't want to add index.html<br/>
 * file to all directory manualy<br/>
 *
 * Display message of success or failure
 * @author Neerav Dobaria < dobaria ##dot## dobaria ##at## gmail.com >
 * @param string $dirPath Path of directory
 * @param string $string Optional String to write on file
 * @return void
 */
function add_index_html($dirPath, $string = "") {
    $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dirPath), RecursiveIteratorIterator::SELF_FIRST);
 
    foreach ($objects as $name => $object) {
        if (is_dir($object->getPathname()) AND FALSE === strpos($object->getPathname(), '.svn')) {
            $dirs[] = $object->getPathname();
        }
    }
    if ("" == $string) {
        $string = '<html>
<body bgcolor="#FFFFFF">
</body>
</html>';
    }
 
    $length = strlen($string);
 
    foreach ($dirs as $dir) {
        $filename = $dir . DIRECTORY_SEPARATOR . 'index.html';
        if (!file_exists($filename)) {
            $fp = fopen($filename, 'w');
            fputs($fp, $string, $length);
            fclose($fp);
            echo $message[] = '<span style="color:green;">' . $filename . ' added successfully<br/>';
            flush();
        }
        else {
            echo $message[] = '<span style="color:red;">' . $filename . ' already exist</span><br/>';
            flush();
        }
    }
}
 
add_index_html(dirname(__FILE__));

?>