<?php
                require('config.php');
                $sql="SELECT n.*,p.image,p.codep FROM notification n,post p WHERE n.codep=p.codep and p.statu ='pending'  ORDER BY n.date DESC";
                $table= $pdo->query($sql);
                while($row = $table->fetch(PDO::FETCH_BOTH)){
                    $text=$row['text'];
                    $date=$row['date'];
                    $codep=$row['codep'];
                    $pattern = '/#(\d+)/';
                    preg_match($pattern, $text, $matches);
                    $number = $matches[1];
                    $imageData = $row['image'];
                    echo "<div class='nchild'>
                    <table>
                        <tr>
                            <td><img  src='data:image/jpeg;base64," . base64_encode($imageData) . "' alt=''></td>
                            <td>$text</td>
                            <td>$date</td>
                            <td>
                            <button class='npost more'value='a$codep'>view the post</button>
                            </td>
                        </tr>
                    </table>
                  
                </div>";

                }
                ?>