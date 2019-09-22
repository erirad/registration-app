<h1>for Specialist</h1>

<table class="table">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Created at</th>
        <th scope="col">Updated at</th>
        <th scope="col">Served</th>
        <th scope="col">Duration</th>
        <th scope="col">Time left</th>
        <th scope="col">Login key</th>
        <th scope="col">Consultant id</th>
        <th scope="col">Action</th>
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
            <td><?php echo $client[0]['created_at'] ?></td>
            <td><?php echo $client[0]['updated_at'] ?></td>
            <td><?php echo $client[0]['served'] ?></td>
            <td><?php echo $client[0]['duration'] ?></td>
            <td>
                <?php echo gmdate("H:i:s", $client[1]['average'] - $client[0]['timespend']) ?>
            </td>
            <td><?php echo $client[0]['login_key'] ?></td>
            <td><?php echo $client[0]['consultant_id'] ?></td>
            <td>
                <a href="/clients/served/<?php echo $client[0]['id']; ?>">
                    finish the consultation
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
