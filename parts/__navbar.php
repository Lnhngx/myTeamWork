<style>
    .container {
        position: absolute;
        right: 0;
        width: calc(100% - 250px);

    }

    .row {
        justify-content: space-between;
        padding: 0 20px;
    }

    .search,
    .insert,
    .editBtn {
        background-color: #2f4f4f;
        color: white
    }

    .search:hover,
    .insert:hover,
    .editBtn:hover {
        color: white;
        background-color: #908a70;
    }

    .searchIp:focus {
        border: 1px solid #908a70;
        box-shadow: 0 0 5px 0 #908a70;
    }

    .editBtn,
    .delBtn {
        color: white;
    }

    .delBtn {
        background-color: #C82C2C;
    }

    .delBtn:hover {
        background-color: #9A572D;
        color: white;
    }

    .tables td, th {
        /* text-align: center; */
        vertical-align: middle;
    }
</style>

<div class="container my-3">
    <div class="row">
        <div class="col-6"><button type="button" class="insert btn btn-outline" id="btn">新增</button></div>
        <div class="col-3">
            <form class="d-flex">
                <input class="searchIp form-control" type="search" placeholder="Search" aria-label="Search">
                <button class="search btn btn-outline" type="submit">Search</button>
            </form>
        </div>
        <div class="bd-example my-5">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                        <th scope="col">Handle</th>
                        <th scope="col">Handle</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="tables">
                        <th scope="row">test</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>
                            <button type="button" class="editBtn btn btn-outline">修改</button>
                            <button type="button" class="delBtn btn btn-outline">刪除</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>