
<div class="modal fade" id="reviewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Your Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <form action="">
                    <div class="col-sm-12">
                        <textarea name="review" id="review_comment" cols="60" rows="3" style="border-radius: 5px;"></textarea>
                    </div>
                    <div class="col-sm-12">
                        <div class="rating-block" onmouseover="selectBackground(event)" onclick="storeReview(event, {{$productdata->id}})">
                            <button type="button" class="btn btn-default btn-grey-input btn-sm review" aria-label="Left Align">
                                <input type="hidden" value="1">
                                <span class="glyphicon glyphicon-star review" aria-hidden="true"></span>
                            </button>
                            <button type="button" class="btn btn-default btn-grey-input btn-sm review" aria-label="Left Align">
                                <input type="hidden" value="2">
                                <span class="glyphicon glyphicon-star review" aria-hidden="true"></span>
                            </button>
                            <button type="button" class="btn btn-default btn-grey-input btn-sm review" aria-label="Left Align">
                                <input type="hidden" value="3">
                                <span class="glyphicon glyphicon-star review" aria-hidden="true"></span>
                            </button>
                            <button type="button" class="btn btn-default btn-grey-input btn-sm review" aria-label="Left Align">
                                <input type="hidden" value="4">
                                <span class="glyphicon glyphicon-star review" aria-hidden="true"></span>
                            </button>
                            <button type="button" class="btn btn-default btn-grey-input btn-sm review" aria-label="Left Align">
                                <input type="hidden" value="5">
                                <span class="glyphicon glyphicon-star review" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>