# 앱 지원
XE 기반의 사이트에서 XE 뷰어 등의 앱을 사용할 수 있도록 json을 생성하는 모듈입니다.

# 액션
## dispAppBasicInfo
사이트의 기본적인 정보를 나타냅니다.
- default_url: 기본 URL
- site_title: 설정 → 일반 → 사이트 제목
- lang_selected: 사이트에서 지원하는 언어 ```{"ko": "한국어"}```
- selected_lang: 사이트에서 기본으로 사용하는 언어
- mobicon_url: 모바일 홈 화면 아이콘
- enable_join: 회원 설정 → 회원 가입 허가
- socialxe: **소셜XE 모듈**이 필요합니다. 모듈이 존재하지 않을 경우 표시되지 않습니다.
	- sns_services: 소셜XE → 일반 → 사용할 서비스 ```["twitter", "facebook"]```
	- sns_login: 소셜XE → SNS 로그인 → SNS 로그인
	- default_login: 소셜XE → SNS 로그인 → 기존 로그인

## dispAppSitemap
앱 지원 모듈에서 설정한 사이트맵을 나타냅니다.
- menu_srl
- menu_list
	- module
	- name
	- desc
	- url

## dispAppMemberInfo
## 비회원
```
{"message_type": "", "error": -1, "message": "권한이 없습니다."}
```
## 회원
- results
	- user_id
	- email_address
	- nick_name
	- profile_image: ```$logged_info->profile_image```와 동일
	- menu_list: ```$logged_info->menu_list```와 동일
