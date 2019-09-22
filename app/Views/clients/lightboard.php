<form method="get" action="/clients/lightboard">
    <div class="row float-right">
        <div class="form-group">
            <select name="limit" class="form-control">
                <option value="5" selected>5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-height">Show</button>
    </div>
</form>
<h1>Lightboard</h1>
<table class="table table-dark">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Time left</th>
        <th scope="col">Consultant id</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data['data'] as $client):
        if ($client[0]['timespend'] > $client[1]['average']) {
            $client[0]['timespend'] = 0;
            $client[1]['average'] = 0;
        } ?>
        <tr>
            <td><?php echo $client[0]['id'] ?></td>
            <td><?php echo $client[0]['name'] ?></td>
            <td>
                <?php echo gmdate("H:i:s", $client[1]['average'] - $client[0]['timespend']) ?>
            </td>
            <td><?php echo $client[0]['consultant_id'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
