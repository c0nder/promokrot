<?php

    require_once "vendor/autoload.php";

    use Lib\File;
    use Lib\File\LocalOrRemoteFile;
    use Lib\File\Handler\TextHandler;
    use Lib\File\Handler\YamlHandler;
    use Lib\Restriction\MimeRestriction;
    use Lib\Strategy\BaseStrategy;

    $restricitonConfig = new LocalOrRemoteFile('restrictions.yml', new YamlHandler());

    $file = new LocalOrRemoteFile('test', new TextHandler());
    $file->addRestriction(new MimeRestriction());
    $file->setConditions($restricitonConfig->getContents());

    var_dump(
        (new File($file, new BaseStrategy()))->doAlgorithm(["substring" => "Nullam"])
    );


    


