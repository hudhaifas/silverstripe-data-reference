<% if $ObjectImage && CanPublicView %>
    <img src="$ObjectImage.Pad(256,256).URL" alt="image" class="img-fluid" />
<% else %>
    <% if ObjectDefaultImage %>
        <img src= "$ObjectDefaultImage" alt="" class="img-fluid" />
    <% else %>
        <img src= "$resourceURL(hudhaifas/silverstripe-data-reference: res/images/default-image.jpg)" alt="" class="img-fluid" />
    <% end_if %>

    <div class="caption" style="">
        <h4>$ObjectTitle.LimitCharacters(110)</h4>
    </div>
<% end_if %>