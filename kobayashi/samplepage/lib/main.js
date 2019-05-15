var btn = document.getElementsByClassName("btn btn-secondary");
for(var i=0;i<btn.length;i++){
  btn[i].onclick=function(){proc.click(this)};
}

var proc={
  data:{
    num:0,
    mark:""
  },
  click:function(e){
    var t = document.getElementById("formula");
    if(t==null){
      return
    }
    if(e.innerHTML==""){return}

    //数字
    var k = e.innerHTML;
    if(k.match(/[0-9]/)){

      if(this.data.mark=="="){
        this.data.mark="";
        this.data.num=0;
        t.value="";
      }

      //数字の追記
      t.value += k;
      //先頭の0をとる
      if(t.value=="00" || !t.value.match(/¥./)){
        t.value = t.value *1;
      }
    }
    //ピリオド
    else if(k=="."){

      //2回目の.は無視する
      if(!t.value.match(/¥./)){
        //記号の追記
        t.value += k;
      }
    }
    //クリア
    else if(k.match(/c/i)){
      //表示のクリア
      t.value = "";
    }

    //記号
    else{

      //+
      if(this.data.mark=="+"){
        this.data.num = this.data.num + (t.value*1);
      }
      //-
      else if(this.data.mark=="-"){
        if(t.value==""){
          if(this.data.mark=="="){
            this.data.mark="";
            this.data.num=0;
            t.value="";
          }

          //マイナスの追記
          t.value += k;
        }
        this.data.num = this.data.num - (t.value*1);
      }
      //*
      else if(this.data.mark=="×" || this.data.mark.match(/x/i)){
        this.data.num = this.data.num * (t.value*1);
      }
      // /
      else if(this.data.mark=="÷"){
        if(t.value==0){
          this.data.num = 0;
        }
        else{
          this.data.num = this.data.num / (t.value*1);
        }
      }

      else{
        this.data.num = (t.value*1);
      }


      //イコール
      if(k=="="){
        t.value = this.data.num;
      }
      else{

        //表示クリア
        t.value = "";
      }
      //押された記号の記憶
      this.data.mark = e.innerHTML;
    }
  }
};
