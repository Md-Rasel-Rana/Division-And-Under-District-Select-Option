<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Under District User </h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Division Name</label>
                                <select type="text" class="form-control form-select" id="DivisionName">
                                    <option value="">Select Division Name</option>                                  
                                </select>
                                <label class="form-label">District Name</label>
                                <select type="text" class="form-control form-select" id="DistrictName">
                                    <option value="">Select District Name</option>                                  
                                </select>
                                <label class="form-label">Distrct Under User Name *</label>
                                <input type="text" class="form-control" id="UserName">
                                <label class="form-label">User Email *</label>
                                <input type="text" class="form-control" id="UserEmail">
                                <label class="form-label"> User Mobile *</label>
                                <input type="text" class="form-control" id="UserMobile">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="Save()" id="save-btn" class="btn  bg-gradient-success" >Save</button>
                </div>
            </div>
    </div>
</div>

<script>
    FillUpForm1();
async function FillUpForm1() {
    let res=await axios.get('/Division-List');
     res.data.forEach(function(item,i){
        let option=` <option value="${item['id']}">${item['name']}</option>`;
            $('#DivisionName').append(option);
    });
}

$('#DivisionName').on('change', function() {
    var divisionId = $(this).val();
    $('#DistrictName').empty();

    axios.get(`/District-List/${divisionId}`)
        .then(function(response) {
            console.log(response); // Log the response to see the structure
            
            // Assuming response.data contains the array of districts
            response.data.forEach(function(district) {
                var option = `<option value="${district.id}">${district.name}</option>`;
                $('#DistrictName').append(option);
            });
        })
        .catch(function(error) {
            console.error('Error fetching district list:', error);
            // Handle the error appropriately, such as displaying a message to the user
        });
});
        async function Save() {
            let DivisionName_ID=document.getElementById('DivisionName').value;
            let DistrictName_ID=document.getElementById('DistrictName').value;
            let UserName=document.getElementById('UserName').value;
            let UserEmail=document.getElementById('UserEmail').value;
            let UserMobile=document.getElementById('UserMobile').value;
            if(UserName.length===0){
                errorToast("User Name  Required !");
            }
           else if(UserEmail.length===0){
                errorToast("User Email  Required !");
            }
           else if(UserMobile.length===0){
                errorToast("User Mobile Required !");
            }else{
                try{
                    document.getElementById('modal-close').click();
                    let response = await axios.post('/user-store',{
                        DivisionName_ID:DivisionName_ID,
                        DistrictName_ID:DistrictName_ID,
                        UserName:UserName,
                        UserEmail:UserEmail,
                        UserMobile:UserMobile,
                    });
                    if(response.status===201){
                        successToast('User created Successfully');
                        document.getElementById('save-form').reset();
                }
            }catch{
                console.log(err);
            }
            
        }
    }

</script>


