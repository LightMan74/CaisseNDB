<?php
function sanitize_output($html)
{
    $search = array(
        '/(\n|^)(\x20+|\t)/',
        '/(\n|^)\/\/(.*?)(\n|$)/',
        '/\n/',
        '/\<\!--.*?-->/',
        '/(\x20+|\t)/', # Delete multispace (Without \n)
        '/\>\s+\</', # strip whitespaces between tags
        '/(\"|\')\s+\>/', # strip whitespaces between quotation ("') and end tags
        '/=\s+(\"|\')/'); # strip whitespaces between = "'
    
       $replace = array(
        "\n",
        "\n",
        " ",
        "",
        " ",
        "><",
        "$1>",
        "=$1");
    
    $html = preg_replace($search, $replace, $html);
    return $html;
}
// Start the buffering //
ob_start("sanitize_output");
?>

<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Generation_V2</title>
<script type="text/javascript">
function showSpoiler(obj) {
    var inner = obj.parentNode.getElementsByTagName("div")[0];
    if (inner.style.display == "none")
        inner.style.display = "";
    else
        inner.style.display = "none";
}

function selectText(obj) {
    const content =
        document.getElementById(obj);
    content.select();
    document.execCommand("copy");
}
</script>
<style>
Html {
    Font-size: 3rem;
}

font {
    color: #FF0000;
}

a {
    text-decoration: underline;
}

table {
    Width: 100%;
    background-color: #D8D8D8;
}

th {
    Font-size: 0.5rem;
}

button {
    Width: 100%;
    Height: 1rem;
    Background-color: Black;
    Color: white;
}

input {
    Width: 100%;
}
</style>
<?php
        session_start();
        include "generationv2func.php";
    ?>
<center>
    Date de création <?php echo date("Y-m-d--H-i-s"); ?>
    </br></br>
    <?php
                v2();
?>
    <?php




// Get the content that is in the buffer and put it in your file //
file_put_contents('../../GenerationV2.html', sanitize_output(ob_get_contents()));
?>