<cfif isdefined("url.schoolfeeviewTERM") AND url.schoolfeeviewTERM NEQ "">
<cfquery name="getschoolfees" datasource="#request.dsn#">
SELECT *
FROM schoolfees, department
WHERE schoolfees.department_id = department.id
AND schoolfees.term_id = #url.schoolfeeviewTERM#
AND schoolfees.user_id = department.user_id
AND schoolfees.user_id = #SESSION.school.id#
group by schoolfees.department_id
</cfquery>

<table class="table table-bordered">
                <tbody>
<caption> School Fees </caption>
  <tr>
  <th>S/N</th>
    <th>DEPARTMENT</th>
    <th>SCHOOL FEES AMOUNT(N)</th>
    <cfif   #SESSION.school.priveledge# NEQ  3 AND #SESSION.school.priveledge# NEQ  4 AND #SESSION.school.priveledge# NEQ  5 AND #SESSION.school.priveledge# NEQ  6 >
		<th>EDIT</th>
    <!--- <th>Delete</th> --->
	</cfif>
  </tr>
  <cfoutput query="getschoolfees">
   <cfif CurrentRow MOD 2 IS 1>
        <cfset bgcolor="#REQUEST.tablecolor1#">
   <cfelse>
    <cfset bgcolor="#REQUEST.tablecolor2#">
   </cfif>
    <tr bgcolor="#bgcolor#">
    <td>#getschoolfees.currentrow# </td>
      <td>#getschoolfees.name#</td>
      <td>#getschoolfees.schoolfees_amount#</td>
          <cfif   #SESSION.school.priveledge# NEQ  3 AND #SESSION.school.priveledge# NEQ  6 AND #SESSION.school.priveledge# NEQ  4 AND #SESSION.school.priveledge# NEQ  5 >

	  <td> <a href="schoolfeesedit.cfm?id=#getschoolfees.schoolfees_id#&TERM=#url.schoolfeeviewTERM#">Edit </A></td>
  <!---  <td><a href="javascript:ColdFusion.navigate('schoolfeesdel.cfm?id=#getschoolfees.schoolfees_id#','admins',
        mycallBack,myerrorhandler)"> Delete </a></td> --->
            </cfif>
    </tr>
  </cfoutput>
  </tbody>
</table>
<br />
</body>
</html>
</cfif>
