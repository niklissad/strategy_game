<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game</title>

    <script type="application/javascript" src="/js/jquery-3.3.1.min.js"></script>
    <script type="application/javascript" src="/js/main.js"></script>

    <style type="text/css">

        .game {
            width: 730px;
            height: 700px;
            margin-left: 200px;
            margin-top: 50px;
        }

        .block {
            width: 100px;
            height: 100px;
            float: bottom;
            float: left;
            border: 1px double black;
        }

        .earth-block {
            border-top: 1px double black;
            height: 50px;
            width: 100%;
        }

        .fly-block {
            border-top: 1px double black;
            height: 50px;
            width: 100%;
        }

        .gameBlock {
            width: 50px;
            height: 50px;
            float: bottom;
            float: left;
        }

        div[earth="Land"] {
            background: #17c613;
        }

        div[earth="Hill"] {
            background: #0d5234;
        }

        div[earth="Swamp"] {
            background: #bbaf89;
        }

        div[earth="Water"] {
            background: #4a81c6;
        }

        .message {
            margin-left: 250px;
            margin-top: 50px;
            font-weight: bold;
        }

        .message_status {
            margin-left: 250px;
        }

        .fly-block:hover, .earth-block:hover {
            border-color: #ff7274;
        }

        .active {
            border-color: #ff7274;
        }

    </style>
</head>
<body>


<div class="message"></div>
<div class="message_status">Зачекайте суперника</div>

<div class="game">
    <?php for ($y = 1; $y < 8; $y++): ?>

        <?php for ($x = 1; $x < 8; $x++): ?>
            <?php $id = "x{$x}y{$y}" ?>
            <div class="block" id="<?php echo $id ?>">
                <div class="fly-block unit-block" id="fly-<?php echo $id ?>" data-fly="1">
                </div>
                <div class="earth-block unit-block" id="earth-<?php echo $id ?>" data-fly="0">
                </div>
            </div>
        <?php endfor; ?>
    <?php endfor; ?>
</div>


</body>
</html>