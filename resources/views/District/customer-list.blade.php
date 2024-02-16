<div class=" container-fluid " >
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>District List</h4>
                </div>
                <div class="align-items-center col">
                    <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn  m-0 bg-gradient-primary">Create District</button>
                </div>
            </div>
            <hr class="bg-dark "/>
            <table class="table" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>No</th>
                    <th>Division Name</th>
                    <th>District Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tableList">

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<script>

DivisionDistrictList();

async function DivisionDistrictList() {
   // showLoader();
    let res=await axios.get("/Division-District-List");
    console.log(res);
   // hideLoader();

    let tableList=$("#tableList");
    let tableData=$("#tableData");

    tableData.DataTable().destroy();
    tableList.empty();

    res.data.forEach(function (item, index) {
    let row = `<tr>
                    <td>${index + 1}</td>
                    <td>${item['name']}</td>`;
    
    // Create a string to hold all district names
    let districtNames = "";

    // Iterate over the districts array of the current item
    item['districts'].forEach(function (district, districtIndex) {
        // Concatenate district names separated by a comma and space
        districtNames += district['name'];
        if (districtIndex < item['districts'].length - 1) {
            districtNames += ',';
        }
    });

    // Add the district names to the row
    row += `<td>${districtNames}</td>
                    <td>
                        <button data-id="${item['id']}" class="btn editBtn btn-sm btn-success">Edit</button>
                        <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-danger">Delete</button>
                    </td>
                 </tr>`;

    // Append the row to the tableList
    tableList.append(row);
});

    $('.editBtn').on('click', async function () {
           let id= $(this).data('id');
          // await FillUpUpdateForm(id)
           $("#update-modal").modal('show');
    })

    $('.deleteBtn').on('click',function () {
        let id= $(this).data('id');
        $("#delete-modal").modal('show');
        $("#deleteID").val(id);
    })

    new DataTable('#tableData',{
        order:[[0,'desc']],
        lengthMenu:[5,10,15,20,30]
    });

}


</script>

