<?php
$systemAdmin = array(
    'Nigar Alam' => 'n.alam@thedentalnexus.in',
    'Pratik Luniya' => 'p.luniya@thedentalnexus.in',
    'Clyde Dsouza'=> 'c.dsouza#thedentalnexus.in'
);
?>
<div class="content-wrapper">
    <div class="row alert alert-danger alert-dismissible">
        <h1>You are not authorize for this page</h1>
        Contact System administrator if you want permission of this page.
        Email ID of System Administrator is:
        <ul>
            <?php
            foreach($systemAdmin as $k=>$v):
                ?><li><a href="mailto:<?php echo $v; ?>"><?php echo $k . ' (' . $v . ')'; ?></a></li><?php
            endforeach;                
            ?>
        </ul>
    </div>
        
</div>