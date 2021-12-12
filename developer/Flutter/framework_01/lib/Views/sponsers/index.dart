import '../../Controllers/SponserController.dart';
import 'package:flutter/cupertino.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import 'package:framework_01_6/helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/sponsers.dart' as messages_ar;
import '../../lang/en/sponsers.dart' as messages_en;
import '../../main.dart';
import '../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import '../Home.dart';
import '../../packages/flutter_staggered_animations/lib/flutter_staggered_animations.dart';
import '../../packages/flutter_pulltorefresh/lib/pull_to_refresh.dart';
import '../../packages/simples_search_bar/lib/simple_search_bar.dart';
import 'package:url_launcher/url_launcher.dart';



class SponsersIndex extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _SponsersIndexState();
  }
}

class _SponsersIndexState extends State<SponsersIndex>{
  //declare variables here
  var language = LanguageHelper.Language;
  List data;
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
  SponserController _SponserController = new SponserController();
    final AppBarController appBarController = AppBarController();

  RefreshController _refreshController =
    RefreshController(initialRefresh: false);

    void _onRefresh() async {
      // monitor network fetch
      await Future.delayed(Duration(milliseconds: 1000));
      // if failed,use refreshFailed()
      //get list data
            _SponserController.index(1,searchText).whenComplete((){
              if(_SponserController.status == true){
                setState(() {
                  data = _SponserController.listData;
                  if(data.length > 0){
                    isNoListData=false;
                    pagesCount = _SponserController.data["data"]["last_page"];
                  }
                });
              }else{
                ShowToast("warning",_SponserController.message);
              }
            });
      _refreshController.refreshCompleted();
    }

    void _onLoading() async {
      // monitor network fetch
      await Future.delayed(Duration(milliseconds: 1000));
      // if failed,use loadFailed(),if no data return,use LoadNodata()
      if (mounted)
        _SponserController.index(newPage,searchText).whenComplete((){
          if(_SponserController.status == true){
            setState(() {
              data.addAll(_SponserController.listData);
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
    //get list data
    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    _SponserController.index(1,searchText).whenComplete((){
      if(_SponserController.status == true){
        setState(() {
          data = _SponserController.listData;
          if(data.length > 0){
            isNoListData=false;
            pagesCount = _SponserController.data["data"]["last_page"];
          }
        });
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }else{
        ShowToast('warning',_SponserController.message);
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
        language =="en" ? messages_en.getTranslation("Sponsers") : messages_ar.getTranslation
                                      ("Sponsers"),
          style: Theme.of(context).textTheme.title,
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
            language =="en" ? messages_en.getTranslation("NoListData") : messages_ar.getTranslation("NoListData"),
            style: Theme.of(context).textTheme.body1,
          ),
        ),
      )
    : Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: <Widget>[

              Expanded(child:
              AnimationLimiter(
                child :SmartRefresher(
                  enablePullDown: true,
                  enablePullUp: true,
                  header: WaterDropMaterialHeader(),
                  footer: CustomFooter(
                    builder: (BuildContext context, LoadStatus mode) {
                      Widget body;
                      if (mode == LoadStatus.idle) {
                        body = Text(language =="en" ? messages_en.getTranslation("pullupload") : messages_ar.getTranslation("pullupload"));
                      }
                      else if (mode == LoadStatus.loading) {
                        body = CupertinoActivityIndicator();
                      }
                      else if (mode == LoadStatus.failed) {
                        body = Text(language =="en" ? messages_en.getTranslation("loadFailed") : messages_ar.getTranslation("loadFailed"));
                      }
                      else if (mode == LoadStatus.canLoading) {
                        body = Text(language =="en" ? messages_en.getTranslation("releaseToloadMore") : messages_ar.getTranslation("releaseToloadMore"));
                      }
                      else {
                        body = Text(language =="en" ? messages_en.getTranslation("NomoreData") : messages_ar.getTranslation("NomoreData"));
                      }
                      return Container(
                        height: 55.0,
                        child: Center(child: body),
                      );
                    },
                  ),
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
                              onTap:()=> launch(data[index]["website_link"]),
                              child: Container(
                                  margin: const EdgeInsets.all(5.0),
                                  // padding: const EdgeInsets.only(left: 10.0,right: 10.0,top: 30.0,bottom: 30.0),
                                  decoration: BoxDecoration(
                                      borderRadius: BorderRadius.all(
                                          Radius.circular(10.0)
                                      ),
                                      border: Border.all(color: Colors.black12)
                                  ),
                                  alignment: language == "en" ? Alignment.centerLeft : Alignment.centerRight  ,
                                  child:
                                  Center(
                                    child: Column(
                                      textDirection: TextDirection.rtl ,
                                      mainAxisAlignment: MainAxisAlignment.center,
                                      crossAxisAlignment: CrossAxisAlignment.center,
                                      children: <Widget>[
                                    ClipRRect(
                                    borderRadius: BorderRadius.circular(20.0),
                                    child:
                                        FadeInImage.assetNetwork(
                                          placeholder:"assets/images/noimage.png" ,
                                          image: "http://192.168.0.101/framework/"+data[index]["logo_image"],
                                          width: 200.0 ,
                                          height: 200.0 ,
                                        )
                                        ),
                                        Padding(
                                          padding: EdgeInsets.only(right: 30.0 , left: 10.0 , top: 0.0) ,
                                          child: Text(
                                            data[index]["name_ar"].toString(),
                                            style: Theme.of(context).textTheme.body1,
                                          ),
                                        )
                                      ],
                                    ),
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
