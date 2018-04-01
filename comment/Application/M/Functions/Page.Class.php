<?php
/** 
 * @author Administrator
 * 
 */
class Page
{
    public $total;
    public $length;
    public $pagenum;
    public $currentpage;
    public $offset;
    public $limit;
    public $prevpage;
    public $nextpage;
    public $url;
    /**
     */
    function __construct($total,$length,$url="")
    {
        $this->total=$total;
        $this->length=$length;
        $this->currentpage=isset($_GET["p"])?$_GET["p"]:1;
        $this->pagenum=ceil($this->total/$this->length);       
        $this->offset=($this->currentpage-1)*$this->length;
        $this->limit="limit {$this->offset},{$this->length}";
        $this->prevpage=$this->currentpage-1;
        $this->url=$url;
        //$this->offset();
        $this->nextpage();
    }
    /*function offset(){
        if($this->currentpage==1){
            $this->offset=0;
        }
        elseif($this->currentpage!=1) {
            $this->offset=($this->currentpage-1)*$this->length;
        }
    }*/
    function nextpage(){
        if ($this->currentpage>=$this->pagenum){
            $this->nextpage=$this->pagenum;
        }
        else {
            $this->nextpage=$this->currentpage+1;
        }
    }
    
    function getPrevpage(){
        return $this->prevpage;
    }
    function getNextpage(){
        return $this->nextpage;
    }
    function getCurrentpage(){
        return $this->currentpage;
    }
    
    /**
     */
    function __destruct()
    {}
    function show(){
           
      echo"<nav aria-label='Page navigation'>
              <ul class='pagination'>
                   <li>
                       <a href='$this->url?p=1' >
                           <span aria-hidden='true'>首页</span>
                       </a>
                   </li>
                   <li><a href='$this->url?p={$this->prevpage}' aria-label='Previous'><span aria-hidden='true'>上一页</span></a></li>
                   <li><a href='$this->url?p={$this->currentpage}'><span aria-hidden='true'>{$this->currentpage}</span></a></li>
                   <li><a href='$this->url?p={$this->nextpage}' aria-label='Next'><span aria-hidden='true'>下一页</span></a></li>                                   
                   <li>
                       <a href='$this->url?p={$this->pagenum}' >
                           <span aria-hidden='true'>尾页</span>
                       </a>
                       <span>共{$this->pagenum}页</span>
                   </li>
                </ul>
            </nav>"
            ;
         
    }
   
}
?>
          
