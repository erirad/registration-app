<?php
if ($data['client']['timespend'] > $data['average']['average']) {
    $data['client']['timespend'] = 0;
    $data['áverage']['average'] = 0;
} ?>

<h1>Hello, <?php echo $data['client']['name']; ?></h1>
<p>
    time left:
    <b><?php echo gmdate("H:i:s", $data['average']['average'] - $data['client']['timespend']); ?></b>
</p>
<a href="/clients/setNewData/<?php echo $data['client']['id'] ?>" class="btn btn-outline-primary">
    Delay the meeting
</a>
<br/><br/>
<a href="/clients/delete/<?php echo $data['client']['id'] ?>" class="btn btn-outline-danger">
    Delete
</a>
<br/><br/>
<p>Your unique link:</p>
<a href="<?php echo DOMAIN; ?>/clients/showClientInfo/<?php echo $data['client']['login_key']; ?>" target="_blank">
    <?php echo DOMAIN; ?>/clients/showClientInfo/<?php echo $data['client']['login_key']; ?>
</a>


<script type="text/javascript">
    var meta = document.createElement('meta');
    meta.httpEquiv = "refresh";
    meta.content = "5";
    document.getElementsByTagName('head')[0].appendChild(meta);

    setTimeout(function () {
        window.location.reload(1);
    }, 5000);
</script>
