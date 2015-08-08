<html>
    <head></head>
    <body>
    <form action="index.php" method="post">
        Zadejte text <input type="text" name="text">
        <input type="submit" name="send" value="Přeložit">
    </form>
    <br /><br /><br />
    <?php

    include_once "Translator.php";

    if (isset($_POST["send"]))
    {
        $translator = new \Helda\PigLatin\Translator();
        foreach ($translator->translate($_POST["text"]) as $item)
        {
            echo $item . " ";
        }
    }
    ?>
    </body>
</html>

