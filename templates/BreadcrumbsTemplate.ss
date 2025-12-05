<% if $Pages %>
    <section class="section--Breadcrumbs">
        <div class="section_content">
            <% loop $Pages %>
                <% if $Last %>$Title.XML<% else %><a href="$Link">$MenuTitle.XML</a> &raquo;<% end_if %>
            <% end_loop %>
        </div>
    </section>
<% end_if %>
