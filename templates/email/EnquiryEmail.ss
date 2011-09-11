<p>The following was submitted from your website enquiry form:</p>
<% control Values %>
<% if Value %><% if IsHidden %><% else %>
	<p><strong>$Name:</strong> $Value</p>
<% end_if %>
<% end_if %>
<% end_control %>