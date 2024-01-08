<!-- popup for show all Information -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" style="font-size: 25px; color: #1B1212;" id="exampleModalLabel">Technical Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row content" style="width: 102%">
                    @if($productdata->category[0] == 53) 
                        <div class="col-md-6">
                            <table width="100" class="table" style="table-layout: fixed;" border='0'>
                                <tbody>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Frame Shape</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->shape =='') NA @else {{$productdata->shape}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Frame Color</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->framecolor =='') NA @else  {{$productdata->framecolor}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Gender</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->gender =='') NA @else {{$productdata->gender}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Brand Name </td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->brandname =='') NA @else  {{$productdata->brandname}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Model No</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->modelno=='') NA @else  {{$productdata->modelno}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Seller Name</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->sellername =='') NA @else {{$productdata->sellername}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Product Sku</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->productsku =='') NA @else  {{$productdata->productsku}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Frame Material</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->framematerial=='') NA @else {{$productdata->framematerial}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Manufacturer</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->manufracturer=='') NA @else {{$productdata->manufracturer}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Country Of Origin</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->countryoforigin=='') NA @else  {{$productdata->countryoforigin}}@endif</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
            
                        <div class="col-md-5">
                            <table width="100" class="table" border='0'> 
                                <tbody>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Frame Width</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->framewidth=='') NA @else  {{$productdata->framewidth}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Height</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->height=='') NA @else {{$productdata->height}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Temple Material</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->templematerial=='') NA @else {{$productdata->templematerial}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Temple Color</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->templecolor=='') NA @else  {{$productdata->templecolor}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Frame Type</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->frametype=='') NA @else  {{$productdata->frametype}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Frame Dimensions </td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->productdimension=='') NA @else  {{$productdata->productdimension}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Warrenty Type</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->warrentytype=='') NA @else {{$productdata->warrentytype}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Weight</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->weight=='') NA @else {{$productdata->weight}}@endif</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
        
                    @elseif($productdata->category[0] == 58)
                        <div class="col-md-6">
                            <table width="100" class="table" style="table-layout: fixed;" border='0'>
                                <tbody>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Brand Name </td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->brandname=='') NA @else {{$productdata->brandname}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Product Sku</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->productsku=='') NA @else  {{$productdata->productsku}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Lens Material</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->lensmaterialtype=='') NA @else  {{$productdata->lensmaterialtype}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Lens Dia</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->diameterlens=='') NA @else  {{$productdata->diameterlens}}@endif</td>
                                    </tr>
                                    @if($productdata->visioneffect != 'Single Vision')
                                        <tr style="border:none;">
                                            <td style="width: 40%; border:none;">Add Power</td>
                                            <td style="width: 5%; text-align: center;border:none;"> : </td>
                                            <td style="width: 54%;border:none;word-wrap: break-word;">@if($productdata->addpowerlens  =='') NA @else  {{$productdata->addpowerlens}}@endif</td>
                                        </tr>
                                    @endif
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Lens Color</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->color=='') NA @else {{$productdata->color}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Lens index</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->lensindex=='') NA @else  {{$productdata->lensindex}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Coating</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->coating=='') NA @else {{$productdata->coating}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Lens Technology</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->lenstechnology=='') NA @else {{$productdata->lenstechnology}}@endif</td>
                                    </tr>
                                    @if($productdata->category[0] == 58)
                                        <tr style="border:none;">
                                            <td style="width: 40%; border:none;">Lens Dia</td>
                                            <td style="width: 5%; text-align: center;border:none;"> : </td>
                                            <td style="width: 54%;border:none;">@if($productdata->diameterlens =='') NA @else  {{$productdata->diameterlens}}@endif</td>
                                        </tr>
                                        <tr style="border:none;">
                                            <td style="width: 40%; border:none;">Sphere</td>
                                            <td style="width: 5%; text-align: center;border:none;"> : </td>
                                            <td style="width: 54%;border:none;word-wrap: break-word;" >@if($productdata->sphere  =='') NA @else  {{$productdata->sphere}}@endif</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table width="100" class="table" style="table-layout: fixed;"  border='0'>
                                <tbody>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Focal Length</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->focallength=='') NA @else  {{$productdata->focallength}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Manufacturer</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->manufracturer=='') NA @else  {{$productdata->manufracturer}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Weight</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->weight=='') NA @else {{$productdata->weight}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Country Of Origin</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->countryoforigin=='') NA @else  {{$productdata->countryoforigin}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Gravity</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->gravity=='') NA @else  {{$productdata->gravity}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Coating Color</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->coatingcolor=='') NA @else  {{$productdata->coatingcolor}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Abbe Value</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->abbevalue=='') NA @else  {{$productdata->abbevalue}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Lens Type</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->visioneffect=='') NA @else  {{$productdata->visioneffect}}@endif</td>
                                    </tr>
                                @if($productdata->category[0] == 58)
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Axis</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;word-wrap: break-word;">@if($productdata->axisnlens  =='') NA @else  {{$productdata->axisnlens}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Cylinder</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;word-wrap: break-word;">@if($productdata->cylinderlens  =='') NA @else  {{$productdata->cylinderlens}}@endif</td>
                                    </tr>
                                @else
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Add Power</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;word-wrap: break-word;">@if($productdata->addpower =='') NA @else  {{$productdata->addpower}}@endif</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    @elseif($productdata->category[0] == 63) 
                        <div class="col-md-5">
                            <table width="100" class="table" style="table-layout: fixed;" border='0'>
                                <tbody>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Frame Shape</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->shape =='') NA @else {{$productdata->shape}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Frame Color </td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->framecolor =='') NA @else  {{$productdata->framecolor}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Gender</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->gender =='') NA @else {{$productdata->gender}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Brand Name</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->brandname =='') NA @else  {{$productdata->brandname}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Model No</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->modelno =='') NA @else  {{$productdata->modelno}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Product Sku</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->productsku =='') NA @else  {{$productdata->productsku}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Frame Material</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->framematerial =='') NA @else {{$productdata->framematerial}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Seller Name</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->sellername =='') NA @else  {{$productdata->sellername}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Frame Type</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->frametype =='') NA @else {{$productdata->frametype}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Manufacturer</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->manufracturer =='') NA @else  {{$productdata->manufracturer}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Warrenty Type</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->warrentytype =='') NA @else {{$productdata->warrentytype}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Frame Dimension</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->productdimension =='') NA @else  {{$productdata->productdimension}}@endif</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
        
                        <div class="col-md-5">
                            <table width="100" class="table" border='0' style="table-layout: fixed;">
                                <tbody>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Frame Width</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->framewidth =='') NA @else  {{$productdata->framewidth}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Temple Material</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->templematerial=='') NA @else {{$productdata->templematerial}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Temple Color</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->templecolor =='') NA @else  {{$productdata->templecolor}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Lens Material</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->lensmaterialtype =='') NA @else  {{$productdata->lensmaterialtype}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Lens Technology</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->lenstechnology =='') NA @else  {{$productdata->lenstechnology}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Weight</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->weight =='') NA @else  {{$productdata->weight}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Country Of Origin</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->countryoforigin =='') NA @else  {{$productdata->countryoforigin}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Height</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->height =='') NA @else  {{$productdata->height}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Lens Technology</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->lenstechnology =='') NA @else  {{$productdata->lenstechnology}}@endif</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @elseif($productdata->category[0] == 72) 
                        <div class="col-md-5">
                            <table width="100" class="table" border='0' style="table-layout: fixed;">
                                <tbody>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Brand Name</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->brandname =='') NA @else  {{$productdata->brandname}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Product Sku</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->productsku =='') NA @else  {{$productdata->productsku}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Model No</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->modelno =='') NA @else  {{$productdata->modelno}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Contact Lense Type</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->lenstype =='') NA @else  {{$productdata->lenstype}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Contact Lens Material</td>
                                        <td style="width: 3%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->contactlensmaterialtype=='') NA @else {{$productdata->contactlensmaterialtype}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Diameter</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->diameter =='') NA @else  {{$productdata->diameter}}@endif</td>
                                    </tr>
                                    @if($productdata->powermin != '')
                                        <tr style="border:none;">
                                            <td style="width: 25%; border:none;">Sphere <?php echo "(" ?> <i class="fa fa-minus"> <?php echo ")" ?></i></td>
                                            <td style="width: 2%; text-align: center;border:none;"> : </td>
                                            <td style="width: 35%;border:none; word-wrap: break-word; overflow-wrap: break-word;">{{$productdata->powermin}}</td>
                                        </tr>
                                    @endif
                                    @if($productdata->powermax!='')
                                        <tr style="border:none;">
                                            <td style="width: 25%; border:none;">Sphere <?php echo "(" ?> <i class="fa fa-plus"> <?php echo ")" ?></i></td>
                                            <td style="width: 3%; text-align: center;border:none;"> : </td>
                                            <td style="width: 35%; border:none; word-wrap: break-word; overflow-wrap: break-word;">{{$productdata->powermax}}</td>
                                        </tr>
                                    @endif
                                        <tr style="border:none;">
                                            <td style="width: 40%; border:none;">Centerthikness</td>
                                            <td style="width: 5%; text-align: center;border:none;"> : </td>
                                            <td style="width: 54%;border:none;">@if($productdata->centerthiknessnew =='') NA @else {{$productdata->centerthiknessnew}}@endif</td>
                                        </tr>
                                    @if($productdata->cylindernew !='')
                                        <tr style="border:none;">
                                            <td style="width: 40%; border:none;">Cylinder</td>
                                            <td style="width: 3%; text-align: center;border:none;"> : </td>
                                            <td style="width: 54%;border:none; word-wrap: break-word; overflow-wrap: break-word;">{{$productdata->cylindernew}}</td>
                                        </tr>
                                    @endif
                                
                                    @if($productdata->axisnew !='')
                                        <tr style="border:none;">
                                            <td style="width: 40%; border:none;">Axis</td>
                                            <td style="width: 3%; text-align: center;border:none;"> : </td>
                                            <td style="width: 54%;border:none; word-wrap: break-word; overflow-wrap: break-word;">{{$productdata->axisnew}}</td>
                                        </tr>
                                    @endif
                                
                                    @if($productdata->addpower !='')
                                        <tr style="border:none;">
                                            <td style="width: 40%; border:none;">Add Power</td>
                                            <td style="width: 5%; text-align: center;border:none;"> : </td>
                                            <td style="width: 54%;border:none;">{{$productdata->addpower}}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
        
                        <div class="col-md-5">
                            <table width="100" class="table" border='0' style="table-layout: fixed;">
                                <tbody>
                                    <tr style="border:none;">
                                        <td style="width: 35%; border:none;">Base Curve</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->basecurve =='') NA @else {{$productdata->basecurve}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 35%; border:none;">water content</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->watercontent =='') NA @else  {{$productdata->watercontent}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 35%; border:none;">Disposability</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->disposability =='') NA @else  {{$productdata->disposability}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 35%; border:none;">Usages Duration</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->usagesduration =='') NA @else  {{$productdata->usagesduration}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 35%; border:none;">Packaging</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->packaging =='') NA @else {{$productdata->packaging}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <input class="getColor" type="hidden" value="{{$productdata->lenscolor}}" disabled>
                                        <td style="width: 35%; border:none;">Contact Lens Color</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td class="lenscolor" style="width: 54%;border:none;"></td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 35%; border:none;">Manufacturer</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->manufracturer =='') NA @else  {{$productdata->manufracturer}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 35%; border:none;">Country Of Origin</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->countryoforigin =='') NA @else {{$productdata->countryoforigin}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 35%; border:none;">Product Weight</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">{{$productdata->weight}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @elseif($productdata->category[0] == 87)
                        <div class="col-md-5">
                            <table width="100" class="table" border='0' style="table-layout: fixed;">
                                <tbody>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Brand Name</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->brandname =='') NA @else  {{$productdata->brandname}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Product Sku</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->productsku =='') NA @else  {{$productdata->productsku}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Net Quantity</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->netquntity =='') NA @else  {{$productdata->netquntity}}@endif</td>
                                    </tr>
                                        <!--<table width="100" class="table" border='0'>-->
                                        <!--<tbody>-->
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Shelf Life</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->shelflife =='') NA @else  {{$productdata->shelflife}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Form</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->form =='') NA @else  {{$productdata->form}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Product Color</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->productcolor =='') NA @else  {{$productdata->productcolor}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Weight</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->weight=='') NA @else  {{$productdata->weight}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Country Of Origin</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->countryoforigin =='') NA @else  {{$productdata->countryoforigin}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Seller Name</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->sellername =='') NA @else  {{$productdata->sellername}}@endif</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
            
                        <div class="col-md-5">
                            <table width="100" class="table" border='0' style="table-layout: fixed;">
                                <tbody>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Frame Dimension</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->productdimension =='') NA @else  {{$productdata->productdimension}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Material</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->material =='') NA @else  {{$productdata->material}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Manufacturer</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->manufracturer =='') NA @else  {{$productdata->manufracturer}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Warrenty Type</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->warrentytype =='') NA @else  {{$productdata->warrentytype}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Packtype</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->packtype =='') NA @else  {{$productdata->packtype}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Usages</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->usages =='') NA @else  {{$productdata->usages}}@endif</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @elseif($productdata->category[0] == 82)
                        <div class="col-md-5">
                            <table width="100" class="table" border='0' style="table-layout: fixed;">
                                <tbody>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Frame Shape</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->shape =='') NA @else  {{$productdata->shape}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Frame Color </td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->framecolor =='') NA @else {{$productdata->framecolor}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Gender</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->gender =='') NA @else  {{$productdata->gender}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Brand Name</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->brandname =='') NA @else {{$productdata->brandname}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Model No</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->modelno =='') NA @else {{$productdata->modelno}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Product Sku</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->productsku =='') NA @else  {{$productdata->productsku}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Frame Material</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->framematerial =='') NA @else {{$productdata->framematerial}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Frame Dimension</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->productdimension =='') NA @else  {{$productdata->productdimension}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Weight</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->weight =='') NA @else  {{$productdata->weight}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Country Of Origin</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->countryoforigin=='') NA @else  {{$productdata->countryoforigin}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Warrenty Type</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->warrentytype =='') NA @else  {{$productdata->warrentytype}}@endif</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
        
                        <div class="col-md-5">
                            <table width="100" class="table" border='0' style="table-layout: fixed;">
                                <tbody>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Frame Width</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->framewidth =='') NA @else  {{$productdata->framewidth}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Height</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->height =='') NA @else  {{$productdata->height}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Temple Material</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->templematerial =='') NA @else {{$productdata->templematerial}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Temple Color</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->templecolor=='') NA @else  {{$productdata->templecolor}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Lens Material</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->lensmaterialtype =='') NA @else {{$productdata->lensmaterialtype}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Lens Color</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->color =='') NA @else {{$productdata->color}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Conditions </td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->conditionsnew =='') NA @else  {{$productdata->conditionsnew}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Lens Technology</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->lenstechnology =='') NA @else {{$productdata->lenstechnology}}@endif</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="width: 40%; border:none;">Manufacturer</td>
                                        <td style="width: 5%; text-align: center;border:none;"> : </td>
                                        <td style="width: 54%;border:none;">@if($productdata->manufracturer =='') NA @else  {{$productdata->manufracturer}}@endif</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>