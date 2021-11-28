const inf_financiera=[];

function add()
{
    let input_inf=document.getElementById("inf_company").value;
    let input_year_1=document.getElementById("year_1").value;
    let input_year_2=document.getElementById("year_2").value;
    let input_year_3=document.getElementById("year_3").value;
    let input_year_4=document.getElementById("year_4").value;
    let input_year_5=document.getElementById("year_5").value;
    let busqueda=parseInt(input_inf);
    var combo = document.getElementById("inf_company");
    var selected = combo.options[combo.selectedIndex].text;
    if((input_inf=="") || (input_year_1=="" || input_year_1=="0") || (input_year_2=="" || input_year_2=="0") || (input_year_3=="" || input_year_3=="0") || (input_year_4=="" || input_year_4=="0") || (input_year_5=="" || input_year_5=="0") )
    {
        M.toast({html: 'Existen campos vacios'});
    }
    else if(inf_financiera.find(element => element == busqueda)){
        
        document.getElementById("name").innerHTML = selected;
        $(document).ready(function(){
            $('.modal').modal();
            $('#modal1').modal('open');
        });
          
    }
    else
    {
        inf_financiera.push(parseInt(input_inf));
        M.toast({html: 'Información registrada'});
        const table=document.querySelector("#table1");
        let string=$("#addInff").serialize();
        $.post("company_CO/addInff",string,function(){});
        table.insertAdjacentHTML("afterbegin", `<tr id=l1${input_inf}><td>${selected}</td><td>${input_year_1}</td><td>${input_year_2}</td><td>${input_year_3}</td><td>${input_year_4}</td><td>${input_year_5}</td><td><a class="btn-flat" onclick="mod(${input_inf},${input_year_1},${input_year_2},${input_year_3},${input_year_4},${input_year_5})"><i class="material-icons">edit</i></a> </td></tr>`);
    }
    
}

function update()
{
    $(document).ready(function(){
        $('.modal').modal();
        $('#modal1').modal('close');
    });
    let string=$("#addInff").serialize();
    $.post("company_CO/upInff",string,function(){});
    let input_inf=document.getElementById("inf_company").value;
    let input_year_1=document.getElementById("year_1").value;
    let input_year_2=document.getElementById("year_2").value;
    let input_year_3=document.getElementById("year_3").value;
    let input_year_4=document.getElementById("year_4").value;
    let input_year_5=document.getElementById("year_5").value;
    var combo = document.getElementById("inf_company");
    var selected = combo.options[combo.selectedIndex].text;
    const tr =document.querySelector("#l1"+input_inf);
    tr.innerHTML=`<td>${selected}</td><td>${input_year_1}</td><td>${input_year_2}</td><td>${input_year_3}</td><td>${input_year_4}</td><td>${input_year_5}</td><td><a class="btn-flat" onclick="mod(${input_inf},${input_year_1},${input_year_2},${input_year_3},${input_year_4},${input_year_5})"><i class="material-icons">edit</i></a> </td>`;
    M.toast({html: 'Información actualizada'});
}
function endCompany()
{
    if(inf_financiera.length==0)
    {
        $.post('company_CO/deleteEmpty',function(respuesta)
        {
        });
        M.toast({html: 'No se registro información, la compañia se elimino'});
        pages('company_VI/show');
    }
    else{
        while(inf_financiera.length) {
            inf_financiera.pop();
        }

        M.toast({html: 'Información enviada'});
        pages('company_VI/show');
    }
}
function mod(id,year_1,year_2,year_3,year_4,year_5)
{
    M.toast({html: "Ingrese los nuevos valores y pulse el boton 'GUARDAR'"});
    document.getElementById("inf_company").value =id;
    $(document).ready(function(){
        $('select').formSelect();
      });
    document.getElementById("year_1").value =year_1;
    document.getElementById("year_2").value =year_2;
    document.getElementById("year_3").value =year_3;
    document.getElementById("year_4").value =year_4;
    document.getElementById("year_5").value =year_5;
}
