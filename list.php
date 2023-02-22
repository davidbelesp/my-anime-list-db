<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./resources/javascript/functions.js"></script>
    <script src="./resources/javascript/main.js"></script>
    <link rel="stylesheet" href="./resources/css/list.css">
    <?php echo '<title>'.$_GET["user"].'\'s List</title>'?>

</head>

<?php 

    if(isset($_GET["user"])){
        
    }

?>

<body>
    <div class="loading">
        <span class="loader"></span>
        <p id="progress"></p>
    </div>

    <div class="content">
        <div class="wrapper">
            <div class="header"></div>
            <div class="list">
                <div class="list-header">
                    <div class="header-image"></div>
                </div>
                <div class="list-content">
                    <table class="list-table">
                        <thead>
                            <th></th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Score</th>
                            <?php 
                            if($_GET["type"] == "manga") echo "<th>Chapters</th>";
                            else echo "<th>Episodes</th>"?>
                        </thead>
                        <tbody class="list-body">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<?php echo "<script>
    var username = '".$_GET['user']."'
    var type = '".$_GET['type']."'
</script>" ?>
<script>
    async function updatePage(type, user){
        const data = await getFullList(type, user)
        await addFullList(data)
    }
    setTimeout(() => {
        updatePage(type,username)
    }, 0);
</script>
</html>
