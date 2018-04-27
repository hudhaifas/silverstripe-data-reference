<% loop References %>
<ol>
    <li>
        <span class="title"><a href="$Link" target="_blank">$Title</a> <% if $Page %><span>(<%t Etymology.PAGE 'Page' %> $Page)</span><% end_if %></span>

        <% if $Description %><p class="details">$Description</p><% end_if %>
        <% if $Details %><p class="details">$Details</p><% end_if %>
    </li>
</ol>
<% end_loop %>