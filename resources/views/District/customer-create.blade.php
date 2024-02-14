<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create District</h5>
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
                                <label class="form-label">Division Under District Name *</label>
                                <input type="text" class="form-control" id="DistrictName">
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
    FillUpForm();
    async function FillUpForm() {
        let res=await axios.get('/Division-List');
         res.data.forEach(function(item,i){
            let option=` <option value="${item['id']}">${item['name']}</option>`;
                $('#DivisionName').append(option);
        });
    }

    async function Save(){
        let DivisionName_ID=document.getElementById('DivisionName').value;
        let DistrictName=document.getElementById('DistrictName').value;
        if(DistrictName.length===0){
            errorToast("Division Name Required !");
        }else{
            try{
                document.getElementById('modal-close').click();
                let res=await axios.post('/District-Save',{
                    DivisionName_ID:DivisionName_ID,
                    DistrictName:DistrictName,
                })
                if(res.status===201){
                    successToast('Division Created Successfully');
                  document.getElementById("save-form").reset();
                } else {
                 errorToast("Request fail !");
            }
            }catch{
                console.log(err);
            }
        }
    }

     
</script>
