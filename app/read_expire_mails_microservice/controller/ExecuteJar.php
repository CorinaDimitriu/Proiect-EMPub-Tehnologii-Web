<?php
while(true) {
            $command1 = "java -jar ./Mailbot.jar unpublish";
            exec($command1);
            echo "command 1 finished";
            sleep(5);
            $command2 = "java -jar ./Mailbot.jar";
            exec($command2);
            echo "command 2 finished";
            sleep(10); 
        }
?>