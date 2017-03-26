<cfinclude template="../../head.cfm">
<cfquery datasource="#request.dsn#" name="getclass">
     		 	SELECT class_id, class_name
      			  from class
         </cfquery>
		<cfif NOT ISDEFINED("form.CLASS") AND NOT ISDEFINED("form.NO")>
<cfform>
<div class="box">
      <div class="box-header">
        <h1 class="text-info"><b><cfoutput> Select Number of Form Fields</cfoutput></b></h1>
      </div>
      <div class="box-body">
<table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
<div class="col-md-6">
	<TR>
        <td>Class: </td><td align="center"> <cfselect query="getclass" name="class" display="class_name"   value="Class_id" > </cfselect></td>
</TR></div>
<div class="col-md-6">
<tr>
        <TD>Number of fields </td><td align="center"> <cfinput  name="no" type="text" validate="integer" required="yes" value="10"></TD>
    </TR></div>
    <tr>
        <TD colspan="2" align="center"><input type="submit"  name="submit" value="View Forms" class="btn bg-navy"/></TD>
    </TR>
</table></div></div>

</cfform>
<cfelse>
<cfquery datasource="#request.dsn#" name="getdept">
            	Select *
                FROM department
				WHERE department.user_id = #SESSION.school.id#
         </cfquery>
<cfquery datasource="#request.dsn#" name="getstudentstatus">
            	Select *
                FROM studentstatus
				WHERE studentstatus_id != 3
         </cfquery>

<cfquery datasource="#request.dsn#" name="getparentss">
            	Select id,concat(parent_alias,' ', parent_fullname) as name
                FROM parent
				WHERE PARENT.user_id = #SESSION.school.id#
         </cfquery>
         <cfquery datasource="#request.dsn#" name="getclass2">
     		 	SELECT class_id, class_name
      			  from class
                  WHERE CLASS.CLASS_ID = #form.class#
         </cfquery>

<div class="box-body">
<cfform  action="multiplestudentinsertproccess.cfm?term=#session.school.term#">
  <table  width="100%" class="table-bodered">
  <tbody>
    <h1 class="box-header">
    Insert <cfoutput> #form.no# Students into #ucase(getclass2.class_name)# </cfoutput>
    </h1>
    </tr>

    <tr valign="baseline">
    <thead>
       <td>S/N</td>
      <td nowrap="nowrap" align="left">Surname</td>
      <td nowrap="nowrap" align="left">Other Names</td>
      <td nowrap="nowrap" align="left">Sex:</td>
      <td nowrap="nowrap" align="left">DOB </td>
      <td nowrap="nowrap" align="left">Parent ini</td>
      <td nowrap="nowrap" align="left">Address</td>
      <td nowrap="nowrap" align="left">Status</td>
      <td nowrap="nowrap" align="left">Mother's Phone</td>
            <td nowrap="nowrap" align="left">Father's Phone</td>
    </thead>
    </tr>


    <Cfloop from="1" to="#form.NO#" index="i">

    <tr>
        <td><cfoutput>#i#</cfoutput> </td>
        <td><cfinput class="form-control select2" type="text" name="student_sname#i#" value=""  size="10"  message="Insert Surname" /></td>
        <td><cfinput class="form-control select2" type="text" name="student_fname#i#" value="" size="10"   message="Insert First Name" /></td>

        <td><cfselect class="form-control select2" name="student_sex#i#" >
        <option value="Male"> Male </option>
        <option value="Female">Female</option>
        </cfselect>
        </td>
       <td><cfinput class="form-control select2"  type="datefield" name="student_dob#i#" size="10" validate="date" value=""/></td>
      <td><cfinput class="form-control select2" type="text" name="parent_alias#i#" maxlength="10"  size="10"  value=""  /></td>
      <td><cftextarea class="form-control select2" name="parent_address#i#" cols="30" rows="3" ></cftextarea></td>
      <td><cfselect class="form-control select2" name="status_id#i#" query="getstudentstatus"  display="studentstatus_name" value="studentstatus_id"></cfselect></td>
      <td><cfinput class="form-control select2" type="text" name="parent_phone#i#" required="yes"   size="5"  value=""  /> </Td>
      <td><cfinput class="form-control select2" type="text" name="parent_mothersphone#i#"  required="yes"  size="5"  value=""  /> </Td>
    </tr>
    <cfoutput>
  <input type="hidden" name="class_id#i#" value="#form.CLASS#" />
  <input type="hidden" name="parent_id#i#" value="0" />
  </cfoutput>
  <cfinput  type="hidden" name="file_no#i#" value="#randrange(200,1000)#" size="10"   message="Insert Admin number" />

</cfloop>
<table  align="center" width="100%">
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">&nbsp;</td><br />
      <td align="center"><input type="submit" value="Save" class="btn bg-navy"/></td>
    </tr>
  </table>
  </table>
  <cfoutput>
    <input type="hidden" name="no" value="#form.no#" /></cfoutput>


  <cfinput type="hidden" name="fuckyou" value="form1" />
</cfform>
</cfif>
</div>

<cfinclude template="../../footer.cfm">
