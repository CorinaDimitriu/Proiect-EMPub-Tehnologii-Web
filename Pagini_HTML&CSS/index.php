<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Document</title>
</head>
<body>
    <!--a narrow banner with the page title aligned left-->
    <div name="banner-root"
    class="
        w3-container 
        w3-center 
        w3-padding-16
        w3-lime
        w3-border-black
        w3-border
    "
    style="
        width: 100%;
        height: 100px;
    ">
        <h1 name="banner-title"
        class="
            w3-border
            w3-border-black
            w3-amber
        " 
        style="
            width:fit-content;
        ">
            HELLO WORLD
        </h1>
    </div>

    <!--A menu bar with the login button-->
    <div name="menu-bar"
    class="
        w3-bar
        w3-lime
        w3-border
        w3-border-black
        w3-center
        w3-padding-16
    ">
        <a name="menu-btn-login" name="menu-btn-login"
        class="
            w3-bar-item 
            w3-button 
            w3-hover-light-green
            w3-right
        " 
        href="#"
        style="
            width:fit-content;
            background-color: green;
            margin-inline: 10px;
        ">
            Login
        </a>
        <a name="menu-btn-filter" id="menu-btn-filter"
        class="
            w3-button
            w3-button 
            w3-hover-light-green
            w3-right
        "
        href="#"
        style="
            width:fit-content;
            background-color: green;
            margin-inline: 10px;
        ">
        Filter
        </a>
        <script>//toggles visibility of the filter menu
            document.getElementById('menu-btn-filter').onclick = () => {
                const doc = document.getElementById('filter-menu');
                if (doc.classList.contains('w3-hide')) {
                    doc.classList.remove('w3-hide');
                } else {
                    doc.classList.add('w3-hide');
                }
            }
        </script>
        
    </div>
    <div name="filter-menu" id="filter-menu"
    class="
        w3-lime
        w3-border
        w3-border-black
        w3-hide
        w3-padding-16
    "
    style="
        padding: 16px;
    ">
        <div>Filter menu (more stuff will go here)</div>
        <label for="filter-password">Password: </label>
        <input type="text" name="filter-password" placeholder="password">
        <br>
        <button name="filter-btn-submit" 
        class="
            w3-button 
            w3-green
        ">Apply</button>
    </div>
    
    <div
    class="
        w3-container
        w3-lime
        w3-padding-16
        w3-border
        w3-border-black
        w3-center
    "
    >
        <?php
            $content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Donec eget nunc vitae nunc tincidunt euismod. 
            Nullam euismod, nisl eget tincidunt consectetur, 
            nunc nisi tincidunt nisi, eget tincidunt nisl ipsum 
            vitae nunc. 
            Nullam euismod, nisl eget tincidunt consectetur, 
            nunc nisi tincidunt nisi, eget tincidunt nisl ipsum 
            vitae nunc. 
            Nullam euismod, nisl eget tincidunt consectetur, 
            nunc nisi tincidunt nisi, eget tincidunt nisl ipsum 
            vitae nunc. 
            Nullam euismod, nisl eget tincidunt consectetur, 
            nunc nisi tincidunt nisi, eget tincidunt nisl ipsum 
            vitae nunc. 
            Nullam euismod, nisl eget tincidunt consectetur, 
            nunc nisi tincidunt nisi, eget tincidunt nisl ipsum 
            vitae nunc. 
            Nullam euismod, nisl eget tincidunt consectetur, 
            nunc nisi tincidunt nisi, eget tincidunt nisl ipsum 
            vitae n";
            $author="";
            for ($i = 0; $i < 10; $i++) {
                $title = "Title " . $i;
                echo "
                <div name='content-root' 
                style='
                    padding:8px
                '
                class='
                    w3-border
                    w3-border-black
                '>
                    <div name='content-title'
                    class='
                        w3-border
                        w3-border-black
                        w3-amber
                    ' 
                    style='
                        width:fit-content;
                        font-size: 32px;
                        padding-inline: 16px;
                    '>
                        $title
                    </div>
                    <div name='content-author'
                    class='
                        w3-border
                        w3-border-black
                        w3-amber
                    '
                    style='
                        font-size: 16px;
                        padding-inline: 16px;
                    '>
                        $author
                    </div>
                    <div name='content-body'
                    class='
                        w3-border
                        w3-border-black
                        w3-amber
                    ' 
                    style='
                        width:fit-content;
                        padding-inline: 16px;
                    '>
                        
                        <p>
                            $content
                        </p>
                    </div>
                </div>";
            }
        
        ?>
    </div>


</body>
</html>