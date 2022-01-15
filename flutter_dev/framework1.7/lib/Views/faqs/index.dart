import '../../Controllers/FaqController.dart';
import 'package:flutter/cupertino.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import '../../helpers/LanguageHelper.dart' as LanguageHelper;
import '../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import '../Home.dart';
import 'package:flutter_staggered_animations/flutter_staggered_animations.dart';
import 'package:pull_to_refresh/pull_to_refresh.dart';


class FaqsIndex extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _FaqsIndexState();
  }
}

class _FaqsIndexState extends State<FaqsIndex>{
  //declare variables here
  var language = LanguageHelper.Language;
  var data;
  bool isNoListData=true;
  bool ViewAddButton=true;
  bool ViewSearchBar=true;
  bool isAdImageEnabled=true;
  String searchText="";
  var Ad;
  String viewType = "ListView";
    int count = 1 ;
    int pagesCount = 1 ;
    int newPage = 2;
  FaqController _FaqController = new FaqController();


  RefreshController _refreshController =
    RefreshController(initialRefresh: false);

    void _onRefresh() async {
      // monitor network fetch
      await Future.delayed(Duration(milliseconds: 1000));
      // if failed,use refreshFailed()
      //get list data
            _FaqController.index(1,searchText).whenComplete((){
              if(_FaqController.status == true){
                setState(() {
                  data = _FaqController.listData;
                  if(data.length > 0){
                    isNoListData=false;
                    pagesCount = _FaqController.data["data"]["last_page"];
                  }
                });
              }else{
                ShowToast("warning",_FaqController.message);
              }
            });
      _refreshController.refreshCompleted();
    }

    void _onLoading() async {
      // monitor network fetch
      await Future.delayed(Duration(milliseconds: 1000));
      // if failed,use loadFailed(),if no data return,use LoadNodata()
      if (mounted)
        _FaqController.index(newPage,searchText).whenComplete((){
          if(_FaqController.status == true){
            setState(() {
              data.addAll(_FaqController.listData);
              newPage++;
            });
          }
          else{
            _refreshController.loadFailed();
          }
        });

      if(newPage > pagesCount){
        _refreshController.loadNoData();
      }
      else{
        _refreshController.loadComplete();
      }

    }

    void _onSearch(String Text){
          setState(() {
            searchText = Text;
            data=null;
            pagesCount = 1 ;
            newPage = 2;
            _refreshController.resetNoData();
            _onRefresh();
          });
        }

  read() async {

    await LanguageHelper.initialize();
    language = LanguageHelper.Language;

    //get list data
    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    _FaqController.index(1,searchText).whenComplete((){
      if(_FaqController.status == true){
        setState(() {
          data = _FaqController.listData;
          if(data.length > 0){
            isNoListData=false;
            pagesCount = _FaqController.data["data"]["last_page"];
          }
        });
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }else{
        ShowToast('warning',_FaqController.message);
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }
    });

  }


  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    read();
  }
  @override
  void dispose() {
    // TODO: implement dispose
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    // TODO: implement build
    SizeConfig().init(context); // for media query
    var screenWidthRatio = 10;
    var screenHightRatio = 35;
    var contenttopalignmentratio=20;
    if(SizeConfig.orientation == Orientation.landscape){
      screenWidthRatio = 20 ;
      screenHightRatio = 55 ;

      contenttopalignmentratio=10;
    }
    else{
      screenWidthRatio = 10 ;
      screenHightRatio = 35 ;

      contenttopalignmentratio=3;
    }
    return Scaffold(
      appBar:
      AppBar(
        title:Text(
        LanguageHelper.trans("faqs","Faqs"),
          style: Theme.of(context).textTheme.subtitle1,
        ),
        centerTitle: true,
        leading: IconButton(icon:Icon(Icons.arrow_back),
        onPressed:() => Navigator.of(context).push(
        MaterialPageRoute(builder: (context) => Home())
        ),
        ),
      ),

      body: isNoListData ?
      Container(
        child: Center(
          child: Text(
            LanguageHelper.trans("app","NoListData"),
            style: Theme.of(context).textTheme.bodyText1,
          ),
        ),
      )
    : Column(
            children: <Widget>[

              Expanded(child:
              AnimationLimiter(
                child :SmartRefresher(
                  enablePullDown: true,
                  enablePullUp: true,
                  header: WaterDropMaterialHeader(),
                  controller: _refreshController,
                  onRefresh: _onRefresh,
                  onLoading: _onLoading,
                  child: ListView.builder(
                    itemCount: data == null ? 0 : data.length,
                    itemBuilder: (BuildContext context, int index){
                      return AnimationConfiguration.staggeredList(
                        position: index,
                        duration: const Duration(milliseconds: 375),
                        child: SlideAnimation(
                          verticalOffset: 50.0,
                          child: FadeInAnimation(
                            child: InkWell(
                              onTap: () {
                              },
                              child: Container(
                                  margin: const EdgeInsets.all(5.0),
                                  padding: const EdgeInsets.only(left: 5.0,right: 5.0,top: 10.0,bottom: 10.0),
                                  decoration: BoxDecoration(
                                      borderRadius: BorderRadius.all(
                                          Radius.circular(10.0)
                                      ),
                                      border: Border.all(color: Colors.black12)
                                  ),
                                  alignment: language == "en" ? Alignment.centerLeft : Alignment.centerRight  ,
                                  child:
                                  Column(
                                    children: <Widget>[
                                      Row(
                                        textDirection: language == "en" ? TextDirection.ltr : TextDirection.rtl,
                                        children: <Widget>[
                                          Padding(
                                            padding: EdgeInsets.only(right: 10.0 , left: 10.0 , top: 0.0) ,
                                            child: Text(
                                              data[index]["question_$language"].toString(),
                                              style: Theme.of(context).textTheme.subtitle1,
                                            ),
                                          ),
                                        ],
                                      ),

                                  Padding(
                                    padding: EdgeInsets.only(right: 10.0 , left: 10.0 , top: 0.0) ,
                                    child: Row(
                                        textDirection: TextDirection.rtl ,
                                        children: <Widget>[
                                          Expanded(
                                            child: Directionality(
                                              textDirection: language == "en" ? TextDirection.ltr : TextDirection.rtl,
                                              child: Text(
                                                 data[index]["answer_$language"].toString() ,
                                                style: Theme.of(context).textTheme.bodyText1,
                                              ),
                                            ),
                                          ),
                                        ],
                                      ),
                                      ),

                                    ],
                                  )
                              ),
                            ),
                          ),
                        ),
                      );
                    },
                  ),
                ),
              ),
              ),
            ],
          ),

        );

  }
}
