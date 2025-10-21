<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
</head>
<body x-data="{'isSettingsModalOpen': false, 'activeTabSettings': 'editProfile', mobile: false, frontFacePreview: null, sideFacePreview: null }" >

@yield('userContent')
    
</body>
</html>