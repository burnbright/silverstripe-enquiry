<p>The following was submitted from your website enquiry form:</p>
<% loop Values %>
	<% if Value %><% if IsHidden %><% else %>
		<p><strong>$Title:</strong> $Value</p>
	<% end_if %><% end_if %>
<% end_loop %>