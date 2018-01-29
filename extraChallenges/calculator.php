<html>
    <head>
        <link rel="stylesheet">
    </head>
    <body>
        <?php
        // setting some default variables
        $x = 0;
        $y = 0;
        $answer = '?';
        $operation = '+';

        if ($_POST){
            // they have submitted the form
            $x = $_POST['x'];
            $y = $_POST['y'];
            $operation = $_POST['operation'];

            if (($x) AND ($y)){
                switch($operation){
                    case '+':
                        $answer = $x + $y;
                        break;
                    case '-':
                        $answer = $x - $y;
                        break;
                    case 'X': 
                        $answer = $x * $y;
                        break;
                    case '÷';
                        $answer = $x / $y;
                        break;
                    case '^';
                        $answer = $x % $y;
                        break;
                    default:
                        break;
                }
            }
        } ?>

        <form action="" method="post">
            <div>
                <input type="text" name="x" size="2" value="<?php echo $x; ?>" />

                <select name="operation">
                    <option value="+"<?php if('+' == $operation) echo ' selected="selected"'; ?>>x+y</option>
                    <option value="-"<?php if('-' == $operation) echo ' selected="selected"'; ?>>x-y</option>
                    <option value="X"<?php if('X' == $operation) echo ' selected="selected"'; ?>>x*y</option>
                    <option value="÷"<?php if('÷' == $operation) echo ' selected="selected"'; ?>>x÷y</option>
                    <option value="^"<?php if('^' == $operation) echo ' selected="selected"'; ?>>x^y</option>
                </select>

                <input type="text" name="y" size="2" value="<?php echo $y; ?>" /> = <?php echo $answer; ?>
            </div>

            <div>
                <input type="submit" value="Calculate" />
            </div>
        </form>
    </body>
</html>