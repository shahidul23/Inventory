class Notyfication{
    success(){
        new Noty({
            type:'success',
            layout:'topRight',
            text: 'Successfully Done',
            timeout:1000
        }).show();
    }
    alart(){
        new Noty({
            type:'alert',
            layout:'topRight',
            text:'Are you sure ?',
            timeout:1000
        }).show();
    }
    error(){
        new Noty({
            type:'error',
            layout:'topRight',
            text:'Somthing want to wrong',
            timeout:1000
        }).show();
    }
    warning(){
        new Noty({
            type:'warning',
            layout:'topRight',
            text:'Oops ! worng',
            timeout:1000
        }),show();
    }
    information(){
        new Noty({
            type:'information',
            layout:'topRight',
            text:'',
            timeout:1000
        }).show();
    }
    info(){
        new Noty({
            type:"info",
            layout:'topRight',
            text:'',
            timeout:1000
        }).show();
    }
}

export default Notyfication = new Notyfication()