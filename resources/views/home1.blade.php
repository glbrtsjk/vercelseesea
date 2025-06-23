
@extends('layouts.app')

@section('title', 'SEESEA - Jelajahi Lautan Konservasi')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-cyan-100 via-blue-50 to-teal-50 relative overflow-hidden">
 
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-cyan-400/20 via-blue-500/20 to-teal-600/30"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-30"></div>
        <div class="floating-particles absolute inset-0"></div>
    </div>


<div class="relative overflow-hidden min-h-screen flex items-center">
    <div class="absolute inset-0 z-0">
        <img src ="{{ asset('home/oceanview.jpg') }}"  alt="Ocean Ecosystem" class="w-full h-full object-cover" />
        <div class="absolute inset-0 bg-gradient-to-b from-blue-300/70 via-blue-500/60 to-blue-700/70"></div>
    </div>

    <div class="hero-ocean-bg absolute inset-0 z-5 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-blue-900/40 via-blue-700/30 to-teal-600/30 animate-pulse-slow"></div>
        <div class="absolute bottom-0 left-0 right-0 h-1/2 bg-gradient-to-t from-blue-900/80 to-transparent"></div>
        <div class="absolute inset-0 opacity-10 mix-blend-overlay animate-drift-slow"
            style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNjAiIGhlaWdodD0iMTYwIiB2aWV3Qm94PSIwIDAgMTYwIDE2MCI+CiAgPCEtLSBFbmhhbmNlZCBEZWZpbml0aW9ucyBmb3IgQmV0dGVyIFVuZGVyd2F0ZXIgRWZmZWN0cyAtLT4KICA8ZGVmcz4KICAgIDwhLS0gQnViYmxlIGdyYWRpZW50cyAtLT4KICAgIDxyYWRpYWxHcmFkaWVudCBpZD0iYnViYmxlR3JhZGllbnQxIiBjeD0iMzAlIiBjeT0iMzAlIiByPSI3MCUiIGZ4PSIzMCUiIGZ5PSIzMCUiPgogICAgICA8c3RvcCBvZmZzZXQ9IjAlIiBzdG9wLWNvbG9yPSIjZmZmZmZmIiBzdG9wLW9wYWNpdHk9IjAuOTUiLz4KICAgICAgPHN0b3Agb2Zmc2V0PSI2MCUiIHN0b3AtY29sb3I9IiNmZmZmZmYiIHN0b3Atb3BhY2l0eT0iMC41Ii8+CiAgICAgIDxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0iI2ZmZmZmZiIgc3RvcC1vcGFjaXR5PSIwLjEiLz4KICAgIDwvcmFkaWFsR3JhZGllbnQ+CiAgICAKICAgIDxyYWRpYWxHcmFkaWVudCBpZD0iYnViYmxlR3JhZGllbnQyIiBjeD0iMzUlIiBjeT0iMzUlIiByPSI2NSUiIGZ4PSIzNSUiIGZ5PSIzNSUiPgogICAgICA8c3RvcCBvZmZzZXQ9IjAlIiBzdG9wLWNvbG9yPSIjZmZmZmZmIiBzdG9wLW9wYWNpdHk9IjAuOSIvPgogICAgICA8c3RvcCBvZmZzZXQ9IjcwJSIgc3RvcC1jb2xvcj0iI2ZmZmZmZiIgc3RvcC1vcGFjaXR5PSIwLjQiLz4KICAgICAgPHN0b3Agb2Zmc2V0PSIxMDAlIiBzdG9wLWNvbG9yPSIjZmZmZmZmIiBzdG9wLW9wYWNpdHk9IjAuMDUiLz4KICAgIDwvcmFkaWFsR3JhZGllbnQ+CiAgICAKICAgIDwhLS0gRmlzaCBncmFkaWVudCAtLT4KICAgIDxsaW5lYXJHcmFkaWVudCBpZD0iZmlzaEdyYWRpZW50MSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIxMDAlIiB5Mj0iMTAwJSI+CiAgICAgIDxzdG9wIG9mZnNldD0iMTAlIiBzdG9wLWNvbG9yPSIjZmZmZmZmIiBzdG9wLW9wYWNpdHk9IjAuOCIvPgogICAgICA8c3RvcCBvZmZzZXQ9IjkwJSIgc3RvcC1jb2xvcj0iI2ZmZmZmZiIgc3RvcC1vcGFjaXR5PSIwLjMiLz4KICAgIDwvbGluZWFyR3JhZGllbnQ+CiAgICAKICAgIDwhLS0gQ29yYWwgZ3JhZGllbnQgLS0+CiAgICA8bGluZWFyR3JhZGllbnQgaWQ9ImNvcmFsR3JhZGllbnQiIHgxPSIwJSIgeTE9IjAlIiB4Mj0iMTAwJSIgeTI9IjEwMCUiPgogICAgICA8c3RvcCBvZmZzZXQ9IjAlIiBzdG9wLWNvbG9yPSIjZmZmZmZmIiBzdG9wLW9wYWNpdHk9IjAuOCIvPgogICAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNmZmZmZmYiIHN0b3Atb3BhY2l0eT0iMC40Ii8+CiAgICA8L2xpbmVhckdyYWRpZW50PgogICAgCiAgICA8IS0tIFNlYXdlZWQgZ3JhZGllbnQgLS0+CiAgICA8bGluZWFyR3JhZGllbnQgaWQ9InNlYXdlZWRHcmFkaWVudCIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgICA8c3RvcCBvZmZzZXQ9IjAlIiBzdG9wLWNvbG9yPSIjZmZmZmZmIiBzdG9wLW9wYWNpdHk9IjAuMiIvPgogICAgICA8c3RvcCBvZmZzZXQ9IjUwJSIgc3RvcC1jb2xvcj0iI2ZmZmZmZiIgc3RvcC1vcGFjaXR5PSIwLjUiLz4KICAgICAgPHN0b3Agb2Zmc2V0PSIxMDAlIiBzdG9wLWNvbG9yPSIjZmZmZmZmIiBzdG9wLW9wYWNpdHk9IjAuMiIvPgogICAgPC9saW5lYXJHcmFkaWVudD4KICAgIAogICAgPCEtLSBFbmhhbmNlZCBnbG93IGVmZmVjdCAtLT4KICAgIDxmaWx0ZXIgaWQ9Imdsb3ciIHg9Ii0yMCUiIHk9Ii0yMCUiIHdpZHRoPSIxNDAlIiBoZWlnaHQ9IjE0MCUiPgogICAgICA8ZmVHYXVzc2lhbkJsdXIgc3RkRGV2aWF0aW9uPSIxLjIiIHJlc3VsdD0iYmx1ciIvPgogICAgICA8ZmVDb21wb3NpdGUgaW49IlNvdXJjZUdyYXBoaWMiIGluMj0iYmx1ciIgb3BlcmF0b3I9Im92ZXIiLz4KICAgIDwvZmlsdGVyPgogICAgCiAgICA8IS0tIFdhdGVyIHNoaW1tZXIgZmlsdGVyIC0tPgogICAgPGZpbHRlciBpZD0ic2hpbW1lciIgeD0iLTIwJSIgeT0iLTIwJSIgd2lkdGg9IjE0MCUiIGhlaWdodD0iMTQwJSI+CiAgICAgIDxmZVR1cmJ1bGVuY2UgdHlwZT0iZnJhY3RhbE5vaXNlIiBiYXNlRnJlcXVlbmN5PSIwLjAxIiBudW1PY3RhdmVzPSIyIiByZXN1bHQ9Im5vaXNlIi8+CiAgICAgIDxmZURpc3BsYWNlbWVudE1hcCBpbj0iU291cmNlR3JhcGhpYyIgaW4yPSJub2lzZSIgc2NhbGU9IjMiIHhDaGFubmVsU2VsZWN0b3I9IlIiIHlDaGFubmVsU2VsZWN0b3I9IkciLz4KICAgIDwvZmlsdGVyPgogIDwvZGVmcz4KICAKICA8IS0tIEVuaGFuY2VkIEJ1YmJsZXMgLS0+CiAgPGNpcmNsZSBjeD0iMjAiIGN5PSIzMCIgcj0iOCIgZmlsbD0idXJsKCNidWJibGVHcmFkaWVudDEpIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMC41IiBvcGFjaXR5PSIwLjgiIGZpbHRlcj0idXJsKCNnbG93KSIvPgogIDxjaXJjbGUgY3g9IjYwIiBjeT0iMTUiIHI9IjUiIGZpbGw9InVybCgjYnViYmxlR3JhZGllbnQyKSIgc3Ryb2tlPSIjZmZmZmZmIiBzdHJva2Utd2lkdGg9IjAuNCIgb3BhY2l0eT0iMC43Ii8+CiAgPGNpcmNsZSBjeD0iMTAwIiBjeT0iNDAiIHI9IjEwIiBmaWxsPSJ1cmwoI2J1YmJsZUdyYWRpZW50MSkiIHN0cm9rZT0iI2ZmZmZmZiIgc3Ryb2tlLXdpZHRoPSIwLjUiIG9wYWNpdHk9IjAuNzUiIGZpbHRlcj0idXJsKCNnbG93KSIvPgogIDxjaXJjbGUgY3g9IjEzMCIgY3k9IjIwIiByPSI2IiBmaWxsPSJ1cmwoI2J1YmJsZUdyYWRpZW50MikiIHN0cm9rZT0iI2ZmZmZmZiIgc3Ryb2tlLXdpZHRoPSIwLjQiIG9wYWNpdHk9IjAuNyIvPgogIDxjaXJjbGUgY3g9IjQwIiBjeT0iODAiIHI9IjciIGZpbGw9InVybCgjYnViYmxlR3JhZGllbnQxKSIgc3Ryb2tlPSIjZmZmZmZmIiBzdHJva2Utd2lkdGg9IjAuNCIgb3BhY2l0eT0iMC43Ii8+CiAgPGNpcmNsZSBjeD0iOTAiIGN5PSI5MCIgcj0iOSIgZmlsbD0idXJsKCNidWJibGVHcmFkaWVudDIpIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMC41IiBvcGFjaXR5PSIwLjgiIGZpbHRlcj0idXJsKCNnbG93KSIvPgogIDxjaXJjbGUgY3g9IjE0MCIgY3k9IjcwIiByPSI0IiBmaWxsPSJ1cmwoI2J1YmJsZUdyYWRpZW50MSkiIHN0cm9rZT0iI2ZmZmZmZiIgc3Ryb2tlLXdpZHRoPSIwLjMiIG9wYWNpdHk9IjAuNjUiLz4KICA8Y2lyY2xlIGN4PSIyNSIgY3k9IjEyMCIgcj0iNiIgZmlsbD0idXJsKCNidWJibGVHcmFkaWVudDIpIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMC40IiBvcGFjaXR5PSIwLjc1Ii8+CiAgPGNpcmNsZSBjeD0iMTE1IiBjeT0iMTEwIiByPSI1IiBmaWxsPSJ1cmwoI2J1YmJsZUdyYWRpZW50MSkiIHN0cm9rZT0iI2ZmZmZmZiIgc3Ryb2tlLXdpZHRoPSIwLjMiIG9wYWNpdHk9IjAuNyIvPgogIDxjaXJjbGUgY3g9Ijc1IiBjeT0iNDUiIHI9IjMiIGZpbGw9InVybCgjYnViYmxlR3JhZGllbnQyKSIgc3Ryb2tlPSIjZmZmZmZmIiBzdHJva2Utd2lkdGg9IjAuMiIgb3BhY2l0eT0iMC42Ii8+CiAgPGNpcmNsZSBjeD0iNTUiIGN5PSIxNDAiIHI9IjciIGZpbGw9InVybCgjYnViYmxlR3JhZGllbnQxKSIgc3Ryb2tlPSIjZmZmZmZmIiBzdHJva2Utd2lkdGg9IjAuNCIgb3BhY2l0eT0iMC43IiBmaWx0ZXI9InVybCgjZ2xvdykiLz4KICA8Y2lyY2xlIGN4PSIxMjUiIGN5PSI1MCIgcj0iNCIgZmlsbD0idXJsKCNidWJibGVHcmFkaWVudDIpIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMC4zIiBvcGFjaXR5PSIwLjY1Ii8+CiAgCiAgPCEtLSBFbmhhbmNlZCBTZWF3ZWVkIHdpdGggbW9yZSByZWFsaXN0aWMgY3VydmVzIC0tPgogIDxwYXRoIGQ9Ik0xMCAxNjAgQzE1IDE1MCwgOCAxNDAsIDEyIDEzMCBDMTYgMTIwLCA1IDExMCwgMTAgMTAwIEMxNSA5MCwgOCA4MCwgMTIgNzAgQzE2IDYwLCA2IDUwLCAxMCA0MCIgCiAgICAgICAgZmlsbD0ibm9uZSIgc3Ryb2tlPSJ1cmwoI3NlYXdlZWRHcmFkaWVudCkiIHN0cm9rZS13aWR0aD0iMS4yIiBvcGFjaXR5PSIwLjYiIGZpbHRlcj0idXJsKCNnbG93KSIgLz4KICAKICA8cGF0aCBkPSJNMzAgMTYwIEMyOCAxNDUsIDM1IDEzMCwgMjUgMTE1IEMyMCAxMDAsIDM1IDg1LCAzMCA3MCBDMjUgNTUsIDM1IDQwLCAzMCAyNSIgCiAgICAgICAgZmlsbD0ibm9uZSIgc3Ryb2tlPSJ1cmwoI3NlYXdlZWRHcmFkaWVudCkiIHN0cm9rZS13aWR0aD0iMC45IiBvcGFjaXR5PSIwLjUiIC8+CiAgCiAgPHBhdGggZD0iTTE1MCAxNjAgQzE1NSAxNDUsIDE0NSAxMzAsIDE1MiAxMTUgQzE0OCAxMDAsIDE1OCA4NSwgMTUwIDcwIEMxNDUgNTUsIDE1NSA0MCwgMTUwIDI1IiAKICAgICAgICBmaWxsPSJub25lIiBzdHJva2U9InVybCgjc2Vhd2VlZEdyYWRpZW50KSIgc3Ryb2tlLXdpZHRoPSIxIiBvcGFjaXR5PSIwLjU1IiAvPgogIAogIDxwYXRoIGQ9Ik01MCAxNjAgQzU0IDE0NSwgNDggMTMwLCA1MiAxMTUgQzQ2IDEwMCwgNTUgODUsIDUwIDcwIEM1NCA1NSwgNDYgNDAsIDUwIDI1IiAKICAgICAgICBmaWxsPSJub25lIiBzdHJva2U9InVybCgjc2Vhd2VlZEdyYWRpZW50KSIgc3Ryb2tlLXdpZHRoPSIwLjgiIG9wYWNpdHk9IjAuNSIgLz4KICAKICA8IS0tIE1vcmUgUmVhbGlzdGljIEZpc2ggU2lsaG91ZXR0ZXMgLS0+CiAgPCEtLSBMYXJnZSBmaXNoIHdpdGggZmlucyBhbmQgdGFpbCAtLT4KICA8ZyBvcGFjaXR5PSIwLjciIGZpbHRlcj0idXJsKCNnbG93KSI+CiAgICA8cGF0aCBkPSJNNzAgNjAgUTg1IDU1IDk1IDYwIFQxMTUgNjAgTDEyMCA2NSBRMTI1IDY3IDEyMCA3MCBUOTUgNzAgUTg1IDc1IDcwIDcwIFoiIAogICAgICAgICAgZmlsbD0idXJsKCNmaXNoR3JhZGllbnQxKSIgc3Ryb2tlPSIjZmZmZmZmIiBzdHJva2Utd2lkdGg9IjAuNyIgLz4KICAgIDxwYXRoIGQ9Ik0xMjAgNjUgTDEyNSA2MCBMMTI1IDcwIEwxMjAgNjUiIAogICAgICAgICAgZmlsbD0idXJsKCNmaXNoR3JhZGllbnQxKSIgc3Ryb2tlPSIjZmZmZmZmIiBzdHJva2Utd2lkdGg9IjAuNyIgLz4KICAgIDxjaXJjbGUgY3g9Ijc4IiBjeT0iNjUiIHI9IjEuNSIgZmlsbD0iI2ZmZmZmZiIgb3BhY2l0eT0iMC45IiAvPgogIDwvZz4KICAKICA8IS0tIFNtYWxsIGZpc2ggd2l0aCBkZXRhaWxlZCBmaW5zIC0tPgogIDxnIG9wYWNpdHk9IjAuNiI+CiAgICA8cGF0aCBkPSJNNTAgMTEwIFE1OCAxMDYgNjYgMTEwIFQ4MCAxMTAgTDg0IDExMyBMODAgMTE2IFQ2NiAxMTYgUTU4IDEyMCA1MCAxMTYgWiIgCiAgICAgICAgICBmaWxsPSJ1cmwoI2Zpc2hHcmFkaWVudDEpIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMC42IiAvPgogICAgPHBhdGggZD0iTTg0IDExMyBMODggMTEwIEw4OCAxMTYgTDg0IDExMyIgCiAgICAgICAgICBmaWxsPSJ1cmwoI2Zpc2hHcmFkaWVudDEpIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMC42IiAvPgogICAgPHBhdGggZD0iTTYyIDExMCBMNjIgMTA1IEw2NSAxMTAiIGZpbGw9InVybCgjZmlzaEdyYWRpZW50MSkiIHN0cm9rZT0iI2ZmZmZmZiIgc3Ryb2tlLXdpZHRoPSIwLjQiIC8+CiAgICA8Y2lyY2xlIGN4PSI1NiIgY3k9IjExMyIgcj0iMSIgZmlsbD0iI2ZmZmZmZiIgb3BhY2l0eT0iMC45IiAvPgogIDwvZz4KICAKICA8IS0tIE1lZGl1bSBmaXNoIHdpdGggY3VydmVkIGJvZHkgLS0+CiAgPGcgb3BhY2l0eT0iMC42NSIgdHJhbnNmb3JtPSJyb3RhdGUoMTUgMTIwIDg1KSI+CiAgICA8cGF0aCBkPSJNMTIwIDg1IFExMjggODEgMTM2IDg1IFQxNTAgODUgTDE1NCA4OCBMMTUwIDkxIFQxMzYgOTEgUTEyOCA5NSAxMjAgOTEgWiIgCiAgICAgICAgICBmaWxsPSJ1cmwoI2Zpc2hHcmFkaWVudDEpIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMC42IiAvPgogICAgPHBhdGggZD0iTTE1NCA4OCBMMTU4IDg1IEwxNTggOTEgTDE1NCA4OCIgCiAgICAgICAgICBmaWxsPSJ1cmwoI2Zpc2hHcmFkaWVudDEpIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMC42IiAvPgogICAgPGNpcmNsZSBjeD0iMTI2IiBjeT0iODgiIHI9IjEuMiIgZmlsbD0iI2ZmZmZmZiIgb3BhY2l0eT0iMC45IiAvPgogIDwvZz4KICAKICA8IS0tIFNob2FsIG9mIHRpbnkgZmlzaCAtLT4KICA8ZyBvcGFjaXR5PSIwLjUiPgogICAgPHBhdGggZD0iTTM1IDUwIEwzOCA0OCBMNDAgNTAgTDM4IDUyIFoiIGZpbGw9IiNmZmZmZmYiIHN0cm9rZT0iI2ZmZmZmZiIgc3Ryb2tlLXdpZHRoPSIwLjMiIC8+CiAgICA8cGF0aCBkPSJNNDAgNDggTDQzIDQ2IEw0NSA0OCBMNDMgNTAgWiIgZmlsbD0iI2ZmZmZmZiIgc3Ryb2tlPSIjZmZmZmZmIiBzdHJva2Utd2lkdGg9IjAuMyIgLz4KICAgIDxwYXRoIGQ9Ik0zOCA1NCBMNDEgNTIgTDQzIDU0IEw0MSA1NiBaIiBmaWxsPSIjZmZmZmZmIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMC4zIiAvPgogICAgPHBhdGggZD0iTTQyIDUwIEw0NSA0OCBMNDcgNTAgTDQ1IDUyIFoiIGZpbGw9IiNmZmZmZmYiIHN0cm9rZT0iI2ZmZmZmZiIgc3Ryb2tlLXdpZHRoPSIwLjMiIC8+CiAgPC9nPgogIAogIDwhLS0gRW5oYW5jZWQgQ29yYWwgU3RydWN0dXJlcyAtLT4KICA8cGF0aCBkPSJNMTIwIDE2MCBDMTIwIDE0NSwgMTI4IDEzNSwgMTM1IDE0MCBDMTQyIDE0NSwgMTQwIDE2MCwgMTQwIDE2MCIgCiAgICAgICAgZmlsbD0ibm9uZSIgc3Ryb2tlPSJ1cmwoI2NvcmFsR3JhZGllbnQpIiBzdHJva2Utd2lkdGg9IjEuNSIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBvcGFjaXR5PSIwLjciIGZpbHRlcj0idXJsKCNnbG93KSIgLz4KICAKICA8cGF0aCBkPSJNMTAwIDE2MCBDMTAwIDE0NSwgOTQgMTM1LCA4NyAxNDAgQzgwIDE0NSwgODAgMTYwLCA4MCAxNjAiIAogICAgICAgIGZpbGw9Im5vbmUiIHN0cm9rZT0idXJsKCNjb3JhbEdyYWRpZW50KSIgc3Ryb2tlLXdpZHRoPSIxLjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgb3BhY2l0eT0iMC42NSIgLz4KICAKICA8cGF0aCBkPSJNNjUgMTYwIEM2NSAxNTAsIDcwIDE0MCwgNzUgMTQ1IEM4MCAxNTAsIDg1IDE0NSwgODUgMTYwIiAKICAgICAgICBmaWxsPSJub25lIiBzdHJva2U9InVybCgjY29yYWxHcmFkaWVudCkiIHN0cm9rZS13aWR0aD0iMSIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBvcGFjaXR5PSIwLjYiIC8+CiAgCiAgPCEtLSBEZXRhaWxlZCBicmFuY2hpbmcgY29yYWwgLS0+CiAgPHBhdGggZD0iTTIwIDE2MCBMMjAgMTQwIE0yMCAxNTAgTDE1IDE0MCBNMjAgMTUwIEwyNSAxNDAgTTIwIDE0NSBMMTggMTM4IE0yMCAxNDUgTDIyIDEzOCIgCiAgICAgICAgZmlsbD0ibm9uZSIgc3Ryb2tlPSJ1cmwoI2NvcmFsR3JhZGllbnQpIiBzdHJva2Utd2lkdGg9IjAuOCIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBvcGFjaXR5PSIwLjciIC8+CiAgCiAgPCEtLSBTZWEgYW5lbW9uZSAtLT4KICA8ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSgxMzAsIDE1MCkiPgogICAgPHBhdGggZD0iTTAgMCBDMiAtMTUsIDQgLTEwLCA2IC0xNSIgc3Ryb2tlPSIjZmZmZmZmIiBzdHJva2Utd2lkdGg9IjAuNSIgb3BhY2l0eT0iMC42IiAvPgogICAgPHBhdGggZD0iTTAgMCBDMCAtMTUsIDIgLTEwLCA0IC0xNyIgc3Ryb2tlPSIjZmZmZmZmIiBzdHJva2Utd2lkdGg9IjAuNSIgb3BhY2l0eT0iMC42IiAvPgogICAgPHBhdGggZD0iTTAgMCBDLTIgLTE1LCAwIC0xMCwgMiAtMTYiIHN0cm9rZT0iI2ZmZmZmZiIgc3Ryb2tlLXdpZHRoPSIwLjUiIG9wYWNpdHk9IjAuNiIgLz4KICAgIDxwYXRoIGQ9Ik0wIDAgQy00IC0xNCwgLTIgLTksIDAgLTE1IiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMC41IiBvcGFjaXR5PSIwLjYiIC8+CiAgICA8cGF0aCBkPSJNMCAwIEMtNiAtMTMsIC00IC04LCAtMiAtMTQiIHN0cm9rZT0iI2ZmZmZmZiIgc3Ryb2tlLXdpZHRoPSIwLjUiIG9wYWNpdHk9IjAuNiIgLz4KICA8L2c+CiAgCiAgPCEtLSBKZWxseWZpc2ggLS0+CiAgPGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMTEwLCAzMCkiIG9wYWNpdHk9IjAuNyI+CiAgICA8cGF0aCBkPSJNMCAwIEM0IDIsIDggMiwgMTIgMCBDMTIgNiwgMCA2LCAwIDAgWiIgZmlsbD0idXJsKCNidWJibGVHcmFkaWVudDIpIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMC40IiAvPgogICAgPHBhdGggZD0iTTIgNiBDMiAxMCwgMiAxNCwgMiAxOCIgc3Ryb2tlPSIjZmZmZmZmIiBzdHJva2Utd2lkdGg9IjAuMyIgLz4KICAgIDxwYXRoIGQ9Ik02IDYgQzYgMTIsIDYgMTUsIDYgMjAiIHN0cm9rZT0iI2ZmZmZmZiIgc3Ryb2tlLXdpZHRoPSIwLjMiIC8+CiAgICA8cGF0aCBkPSJNMTAgNiBDMTAgMTAsIDEwIDE0LCAxMCAxOCIgc3Ryb2tlPSIjZmZmZmZmIiBzdHJva2Utd2lkdGg9IjAuMyIgLz4KICA8L2c+CiAgCiAgPCEtLSBXYXRlciBzdXJmYWNlIHJpcHBsZSBlZmZlY3QgYXQgdG9wIC0tPgogIDxwYXRoIGQ9Ik0wIDEwIFEyMCA1LCA0MCAxMCBUODAgMTAgVDEyMCAxMCBUMTYwIDEwIiAKICAgICAgICBmaWxsPSJub25lIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMC41IiBvcGFjaXR5PSIwLjMiIC8+CiAgPHBhdGggZD0iTTAgMTUgUTMwIDEwLCA2MCAxNSBUMTIwIDE1IFQxODAgMTUiIAogICAgICAgIGZpbGw9Im5vbmUiIHN0cm9rZT0iI2ZmZmZmZiIgc3Ryb2tlLXdpZHRoPSIwLjQiIG9wYWNpdHk9IjAuMiIgLz4KPC9zdmc+');"></div>
    </div>

    <div class="absolute inset-0 z-10">
        <div class="deep-sea-bubbles absolute inset-0"></div>
        <div class="light-rays absolute inset-0"></div>
        <div class="floating-particles absolute inset-0"></div>


    </div>
    <div class="absolute bottom-20 left-0 right-0 z-5 opacity-30 select-none pointer-events-none">
        <div class="fish-group absolute bottom-10 left-1/4 animate-wave" style="animation-delay: -2s;">
            <svg width="120" height="40" viewBox="0 0 120 40" fill="white" xmlns="http://www.w3.org/2000/svg">
                <path d="M30,15 Q40,5 55,10 T80,15 L80,20 Q70,25 55,20 T30,20 Z"></path>
                <circle cx="75" cy="17" r="3"></circle>
            </svg>
        </div>
        <div class="fish-group absolute bottom-40 right-1/4 animate-wave" style="animation-delay: -4s;">
            <svg width="80" height="30" viewBox="0 0 80 30" fill="white" xmlns="http://www.w3.org/2000/svg">
                <path d="M20,10 Q30,0 40,5 T60,10 L60,15 Q50,20 40,15 T20,15 Z"></path>
                <circle cx="55" cy="12" r="2"></circle>
            </svg>
        </div>
    </div>


      <div class="container mx-auto px-4 relative z-20 text-center">
        <div class="max-w-4xl mx-auto pt-40 pb-16">
            <h1 class="font-serif text-6xl md:text-7xl font-bold text-white mb-6 leading-tight drop-shadow-lg tracking-wide">
                <span class="word-reveal block">Jelajahi</span>
                <span class="word-reveal block" style="animation-delay: 300ms;">Kedalaman</span>
                <span class="word-reveal block gradient-text text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 via-white to-cyan-200" style="animation-delay: 600ms;">Lautan</span>
                <span class="word-reveal block" style="animation-delay: 900ms;">Pengetahuan</span>
            </h1>

            <p class="text-xl md:text-2xl mb-12 text-cyan-100 max-w-3xl mx-auto leading-relaxed animate-fade-in tracking-wide drop-shadow-lg" style="animation-delay: 1200ms; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                Navigasi melalui kedalaman pengetahuan yang dikurasi oleh komunitas pakar kelautan dan penggemar laut. Jelajahi misteri di bawah gelombang.
            </p>

            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center animate-fade-in" style="animation-delay: 1500ms;">
                <a href="{{ route('articles.index') }}" class="group bg-white/90 text-blue-700 px-10 py-5 rounded-full font-bold hover:bg-white transition-all duration-300 shadow-2xl transform hover:-translate-y-2 hover:shadow-cyan-500/25 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Jelajahi Artikel Kelautan
                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>

                @auth
                    <a href="{{ route('articles.create') }}" class="group bg-transparent border-2 border-white/50 backdrop-blur-sm px-10 py-5 rounded-full font-bold hover:bg-white hover:text-blue-700 transition-all duration-300 flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Bagikan Penemuan Anda
                    </a>
                @else
                    <a href="{{ route('register') }}" class="group bg-transparent border-2 border-white/50 backdrop-blur-sm px-10 py-5 rounded-full font-bold hover:bg-white hover:text-blue-700 transition-all duration-300 flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Gabung Komunitas Kelautan
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 w-full">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto">
            <path fill="#f0fdff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</div>
        <div class="absolute bottom-0 left-0 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto">
                <path fill="#f0fdff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </div>

    <div class="container mx-auto px-4 py-16 -mt-32 relative z-30">
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/20 max-w-6xl mx-auto glow-border animate-on-scroll">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-2 typewriter overflow-hidden whitespace-nowrap mx-auto">Navigasi Lautan Pengetahuan</h2>
                <p class="text-gray-600">Cari di kedalaman kebijaksanaan dan penemuan kelautan</p>
            </div>

            <form action="{{ route('articles.search') }}" method="GET" class="flex flex-col lg:flex-row gap-4 animate-on-scroll">
                <div class="flex-grow relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" name="query" placeholder="Cari yang menarik minat Anda..." class="w-full pl-12 pr-6 py-5 rounded-2xl border-2 border-gray-200 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 text-lg bg-white/50 backdrop-blur-sm">
                </div>
                <div class="w-full lg:w-80">
                    <select name="category" class="w-full px-6 py-5 rounded-2xl border-2 border-gray-200 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 appearance-none bg-white/50 backdrop-blur-sm text-lg">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}">{{ $category->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="w-full lg:w-auto bg-gradient-to-r from-cyan-500 to-blue-600 text-white px-10 py-5 rounded-2xl font-bold hover:from-cyan-600 hover:to-blue-700 transition-all duration-300 shadow-xl transform hover:-translate-y-1 flex items-center justify-center pulse-ring">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Telusuri
                    </button>
                </div>
            </form>

            <div class="mt-8 flex flex-wrap gap-3 justify-center animate-on-scroll">
                <span class="text-sm text-gray-500 flex items-center mr-4 font-medium">Kategori Populer:</span>
                @foreach($categories->take(5) as $category)
                    <a href="{{ route('articles.index', ['category' => $category->category_id]) }}" class="bg-gradient-to-r from-cyan-50 to-blue-50 text-cyan-700 px-6 py-2 rounded-full text-sm hover:from-cyan-100 hover:to-blue-100 transition-all duration-300 border border-cyan-200 hover:border-cyan-300 transform hover:scale-105">
                        {{ $category->nama_kategori }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

   <div class="py-20 relative overflow-hidden">
    <div class="absolute inset-0 z-0 bg-gradient-to-r from-cyan-50/80 via-blue-50/90 to-cyan-50/80"></div>

    <div class="absolute inset-0 z-0 floating-gallery-bubbles"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-12 animate-on-scroll">
           <div class="inline-flex items-center bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-700 px-6 py-2 rounded-full mb-4 font-medium shadow-lg transform hover:scale-105 transition-transform duration-300 ring-2 ring-blue-200 ring-offset-2">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"></path>
                    <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
             <span class="relative">
                <span class="relative z-10"> Galeri Kelautan </span>
                <span class="absolute bottom-0 left-0 w-full h-2 bg-gradient-to-r from-transparent via-blue-300/30 to-transparent animate-pulse"></span>
            </span>
        </div>
            <h2 class="text-4xl md:text-5xl font-bold mb-4 slide-in-left bg-clip-text text-transparent bg-gradient-to-r from-blue-700 via-cyan-600 to-teal-500">
                Jelajahi <span class="italic">Dunia Bawah Laut</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto slide-in-right">
                Nikmati visual menakjubkan dari kedalaman lautan kita
            </p>
        </div>

<div class="relative overflow-hidden mb-12 bg-gradient-to-r from-blue-50 via-cyan-50 to-blue-50">
    <div class="absolute inset-0 z-0 opacity-10">
        <div class="absolute -top-20 -right-20 w-64 h-64 bg-cyan-300 rounded-full mix-blend-multiply filter blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-32 -left-20 w-80 h-80 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl animate-pulse" style="animation-delay: 1s"></div>
        <div class="absolute top-1/2 left-1/4 w-40 h-40 bg-teal-200 rounded-full mix-blend-multiply filter blur-2xl animate-pulse" style="animation-delay: 2s"></div>
    </div>

    <div class="absolute top-10 left-10 text-blue-200 opacity-30 animate-bounce" style="animation-duration: 6s">
        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.05 3.636a1 1 0 010 1.414 7 7 0 000 9.9 1 1 0 11-1.414 1.414 9 9 0 010-12.728 1 1 0 011.414 0zm9.9 0a1 1 0 011.414 0 9 9 0 010 12.728 1 1 0 11-1.414-1.414 7 7 0 000-9.9 1 1 0 010-1.414zM7.879 6.464a1 1 0 010 1.414 3 3 0 000 4.243 1 1 0 11-1.414 1.414 5 5 0 010-7.07 1 1 0 011.414 0zm4.242 0a1 1 0 011.414 0 5 5 0 010 7.072 1 1 0 01-1.414-1.414 3 3 0 000-4.242 1 1 0 010-1.415z" clip-rule="evenodd" />
        </svg>
    </div>
    <div class="absolute top-1/4 right-20 text-cyan-200 opacity-20 animate-pulse" style="animation-duration: 8s">
        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
        </svg>
    </div>

    <div class="text-center mb-8 relative z-10 animate-on-scroll">
        <div class="inline-flex items-center bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-700 px-6 py-2 rounded-full mb-4 font-medium shadow-lg transform hover:scale-105 transition-transform duration-300 ring-2 ring-blue-200 ring-offset-2">
            <svg class="w-5 h-5 mr-2 text-blue-600 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
            </svg>
            <span class="relative">
                <span class="relative z-10">Artikel Terbaru</span>
                <span class="absolute bottom-0 left-0 w-full h-2 bg-gradient-to-r from-transparent via-blue-300/30 to-transparent animate-pulse"></span>
            </span>
        </div>

        <h2 class="text-3xl md:text-5xl font-bold mb-2 relative slide-in-left">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-800 via-blue-600 to-cyan-600">Temukan</span>
            <span class="relative inline-block">
                <span class="text-blue-600 relative z-10">Penemuan Terkini</span>
                <svg class="absolute -bottom-2 left-0 w-full h-3 text-blue-200" viewBox="0 0 100 10" preserveAspectRatio="none">
                    <path d="M0,0 C20,8 50,8 100,0 L100,10 L0,10 Z" fill="currentColor"></path>
                </svg>
            </span>
        </h2>

        <p class="text-lg text-gray-600 max-w-2xl mx-auto slide-in-right relative">
            <span class="bg-gradient-to-r from-transparent via-blue-50 to-transparent px-4 py-1">
                Artikel terbaru dari para peneliti dan pakar kelautan
            </span>
        </p>
    </div>

    <div class="horizontal-scroll-container">
    <div class="flex auto-scroll py-10 relative ">
        @foreach($latestArticles as $article)
            <div class="flex-shrink-0 w-96 h-72 mx-4 rounded-2xl overflow-hidden shadow-2xl transform transition-all duration-500 hover:scale-105 hover:rotate-1 gallery-card group">
                <div class="relative w-full h-full">
                    @if($article->gambar)
                        <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-cyan-400 to-blue-500 flex items-center justify-center">
                            <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path>
                            </svg>
                        </div>
                    @endif

                    <div class="absolute top-4 left-4 bg-gradient-to-r from-blue-600 to-sky-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg transform -rotate-2 scale-0 group-hover:scale-100 transition-all duration-300">
                        BARU
                    </div>

                    <div class="absolute top-4 right-4 bg-white/80 backdrop-blur-sm text-xs font-medium px-3 py-1 rounded-full flex items-center">
                        <svg class="w-3 h-3 text-blue-600 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                      {{ $article->tgl_upload ? \App\Helpers\IndonesiaTimeHelper::diffForHumans($article->tgl_upload) : 'Baru' }}
                    </div>

                    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-700/70 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-6">
                        @if($article->category)
                            <span class="bg-blue-500/80 backdrop-blur-sm text-white text-xs py-1 px-3 rounded-full w-fit mb-3 transform -translate-y-4 group-hover:translate-y-0 transition-all duration-500 delay-100">
                                {{ $article->category->nama_kategori }}
                            </span>
                        @endif

                        <h3 class="text-white font-bold text-xl mb-3 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            {{ $article->judul }}
                        </h3>

                        <p class="text-blue-100 text-sm mb-4 opacity-0 group-hover:opacity-100 transition-all duration-300 delay-150 line-clamp-2">
                            {{ Str::limit(strip_tags($article->konten_isi_artikel), 80) }}
                        </p>

                        <div class="flex items-center justify-between opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-200">
                            <div class="flex items-center">
                                @if($article->user && $article->user->profile_photo)
                                    <img src="{{ asset('storage/' . $article->user->profile_photo) }}" alt="{{ $article->user->name }}" class="w-8 h-8 rounded-full mr-2 border-2 border-white">
                                @else
                                    <div class="w-8 h-8 bg-blue-200 text-blue-600 rounded-full flex items-center justify-center mr-2 border-2 border-white">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                @endif
                                <span class="text-white text-xs">{{ $article->user->name ?? 'Penulis' }}</span>
                            </div>
                            <a href="{{ route('articles.show', $article->slug) }}" class="bg-white/20 backdrop-blur-sm text-white px-4 py-1.5 rounded-full text-sm hover:bg-white/40 transition flex items-center">
                                Baca
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="absolute inset-0 bg-gradient-to-tr from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 transform rotate-15 translate-x-full group-hover:translate-x-[-60%]"></div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="flex justify-center mt-6 gap-3">
        <button class="scroll-button-left bg-white text-blue-600 rounded-full w-12 h-12 flex items-center justify-center shadow-lg hover:bg-blue-50 transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button class="scroll-button-right bg-white text-blue-600 rounded-full w-12 h-12 flex items-center justify-center shadow-lg hover:bg-blue-50 transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>

    <div class="absolute top-1/2 right-0 transform -translate-y-1/2 z-10 opacity-30 rotate-180">
        <svg width="100" height="60" viewBox="0 0 100 60" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20 30Q30 25 45 30T70 30L75 35Q80 37 75 40T45 40Q30 45 20 40Z" fill="url(#fishGradient2)" stroke="#0284c7" stroke-width="1"/>
            <circle cx="30" cy="35" r="2" fill="#0284c7"/>
            <defs>
                <linearGradient id="fishGradient2" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="10%" stop-color="#0ea5e9" stop-opacity="0.8"/>
                    <stop offset="90%" stop-color="#0284c7" stop-opacity="0.3"/>
                </linearGradient>
            </defs>
        </svg>
    </div>
</div>
</div>

<div class="relative overflow-hidden mb-12  bg-gradient-to-b from-blue-100/8 blue-100/75 to-blue-100/80 ">
     <div class="text-center mb-8 relative z-10 animate-on-scroll">
        <div class="inline-flex items-center bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-700 px-6 py-2 rounded-full mb-4 font-medium shadow-lg transform hover:scale-105 transition-transform duration-300 ring-2 ring-blue-200 ring-offset-2">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"></path>
                    <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
             <span class="relative">
                <span class="relative z-10">Galeri Kelautan</span>
                <span class="absolute bottom-0 left-0 w-full h-2 bg-gradient-to-r from-transparent via-blue-300/30 to-transparent animate-pulse"></span>
            </span>
        </div>

        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2 slide-in-left">
            <span class="text-blue-600">Keindahan Visual</span> Dunia Laut
        </h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto slide-in-right">
            Jelajahi koleksi foto menakjubkan dari ekosistem kelautan
        </p>
    </div>

    <div class="flex auto-scroll py-10 px-14 relative">
        <div class="flex-shrink-0 w-96 h-72 mx-4 rounded-2xl overflow-hidden shadow-2xl transform transition-all duration-500 hover:scale-105 hover:rotate-1 gallery-card group">
            <div class="relative w-full h-full">
                <img src="{{ asset('home/ocean1.jpg') }}" alt="Keindahan Terumbu Karang" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                <div class="absolute top-4 left-4 bg-gradient-to-r from-blue-600 to-sky-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg transform -rotate-2 scale-0 group-hover:scale-100 transition-all duration-300">
                    TERUMBU KARANG
                </div>

                <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-700/70 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-6">
                    <h3 class="text-white font-bold text-xl mb-3 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        Keindahan Terumbu Karang
                    </h3>
                    <p class="text-blue-100 text-sm mb-4 opacity-0 group-hover:opacity-100 transition-all duration-300 delay-150 line-clamp-2">
                        Keanekaragaman hayati yang luar biasa pada terumbu karang menjadi rumah bagi ribuan spesies laut.
                    </p>
                </div>

                <div class="absolute inset-0 bg-gradient-to-tr from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 transform rotate-15 translate-x-full group-hover:translate-x-[-60%]"></div>
            </div>
        </div>

        <div class="flex-shrink-0 w-96 h-72 mx-4 rounded-2xl overflow-hidden shadow-2xl transform transition-all duration-500 hover:scale-105 hover:rotate-1 gallery-card group">
            <div class="relative w-full h-full">
                <img src="{{ asset('home/hewanlangkah.jpg') }}" alt="Hewan Laut Langka" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                <div class="absolute top-4 left-4 bg-gradient-to-r from-blue-600 to-sky-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg transform -rotate-2 scale-0 group-hover:scale-100 transition-all duration-300">
                    HEWAN LANGKA
                </div>

                <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-700/70 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-6">
                    <h3 class="text-white font-bold text-xl mb-3 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        Hewan Laut Langka
                    </h3>
                    <p class="text-blue-100 text-sm mb-4 opacity-0 group-hover:opacity-100 transition-all duration-300 delay-150 line-clamp-2">
                        Beragam spesies langka yang membutuhkan perlindungan ekstra untuk kelangsungan hidup mereka.
                    </p>
                </div>

                <div class="absolute inset-0 bg-gradient-to-tr from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 transform rotate-15 translate-x-full group-hover:translate-x-[-60%]"></div>
            </div>
        </div>

        <div class="flex-shrink-0 w-96 h-72 mx-4 rounded-2xl overflow-hidden shadow-2xl transform transition-all duration-500 hover:scale-105 hover:rotate-1 gallery-card group">
            <div class="relative w-full h-full">
                <img src="{{ asset('home/lautdalam.jpg') }}" alt="Laut Dalam" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                <div class="absolute top-4 left-4 bg-gradient-to-r from-blue-600 to-sky-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg transform -rotate-2 scale-0 group-hover:scale-100 transition-all duration-300">
                    LAUT DALAM
                </div>

                <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-700/70 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-6">
                    <h3 class="text-white font-bold text-xl mb-3 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        Misteri Laut Dalam
                    </h3>
                    <p class="text-blue-100 text-sm mb-4 opacity-0 group-hover:opacity-100 transition-all duration-300 delay-150 line-clamp-2">
                        Eksplorasi zona laut dalam yang belum terjamah dan menyimpan berbagai rahasia alam.
                    </p>
                </div>

                <div class="absolute inset-0 bg-gradient-to-tr from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 transform rotate-15 translate-x-full group-hover:translate-x-[-60%]"></div>
            </div>
        </div>

        <div class="flex-shrink-0 w-96 h-72 mx-4 rounded-2xl overflow-hidden shadow-2xl transform transition-all duration-500 hover:scale-105 hover:rotate-1 gallery-card group">
            <div class="relative w-full h-full">
                <img src="{{ asset('home/mangrove.jpg') }}" alt="Ekosistem Mangrove" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                <div class="absolute top-4 left-4 bg-gradient-to-r from-blue-600 to-sky-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg transform -rotate-2 scale-0 group-hover:scale-100 transition-all duration-300">
                    MANGROVE
                </div>

                <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-700/70 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-6">
                    <h3 class="text-white font-bold text-xl mb-3 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        Ekosistem Mangrove
                    </h3>
                    <p class="text-blue-100 text-sm mb-4 opacity-0 group-hover:opacity-100 transition-all duration-300 delay-150 line-clamp-2">
                        Pelindung pesisir yang menjadi rumah bagi berbagai spesies dan mencegah erosi pantai.
                    </p>
                </div>

                <div class="absolute inset-0 bg-gradient-to-tr from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 transform rotate-15 translate-x-full group-hover:translate-x-[-60%]"></div>
            </div>
        </div>

        <div class="flex-shrink-0 w-96 h-72 mx-4 rounded-2xl overflow-hidden shadow-2xl transform transition-all duration-500 hover:scale-105 hover:rotate-1 gallery-card group">
            <div class="relative w-full h-full">
                <img src="{{ asset('beach.jpg') }}" alt="Keindahan Pantai" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                <div class="absolute top-4 left-4 bg-gradient-to-r from-blue-600 to-sky-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg transform -rotate-2 scale-0 group-hover:scale-100 transition-all duration-300">
                    PANTAI
                </div>

                <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-700/70 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-6">
                    <h3 class="text-white font-bold text-xl mb-3 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        Keindahan Pantai
                    </h3>
                    <p class="text-blue-100 text-sm mb-4 opacity-0 group-hover:opacity-100 transition-all duration-300 delay-150 line-clamp-2">
                        Garis pantai menakjubkan dengan pasir putih dan perairan jernih yang menenangkan jiwa.
                    </p>
                </div>

                <div class="absolute inset-0 bg-gradient-to-tr from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 transform rotate-15 translate-x-full group-hover:translate-x-[-60%]"></div>
            </div>
        </div>

        <div class="flex-shrink-0 w-96 h-72 mx-4 rounded-2xl overflow-hidden shadow-2xl transform transition-all duration-500 hover:scale-105 hover:rotate-1 gallery-card group">
            <div class="relative w-full h-full">
                <img src="{{ asset('home/konservasi.jpg') }}" alt="Konservasi Laut" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                <div class="absolute top-4 left-4 bg-gradient-to-r from-blue-600 to-sky-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg transform -rotate-2 scale-0 group-hover:scale-100 transition-all duration-300">
                    KONSERVASI
                </div>

                <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-700/70 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-6">
                    <h3 class="text-white font-bold text-xl mb-3 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        Konservasi Laut
                    </h3>
                    <p class="text-blue-100 text-sm mb-4 opacity-0 group-hover:opacity-100 transition-all duration-300 delay-150 line-clamp-2">
                        Upaya pelestarian untuk melindungi ekosistem laut dari berbagai ancaman lingkungan.
                    </p>
                </div>

                <div class="absolute inset-0 bg-gradient-to-tr from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 transform rotate-15 translate-x-full group-hover:translate-x-[-60%]"></div>
            </div>
        </div>
    </div>

    <div class="flex justify-center mt-6 gap-3">
        <button class="scroll-button-left bg-white text-blue-600 rounded-full w-12 h-12 flex items-center justify-center shadow-lg hover:bg-blue-50 transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button class="scroll-button-right bg-white text-blue-600 rounded-full w-12 h-12 flex items-center justify-center shadow-lg hover:bg-blue-50 transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>

    <div class="absolute top-1/2 right-0 transform -translate-y-1/2 z-10 opacity-30 rotate-180">
        <svg width="100" height="60" viewBox="0 0 100 60" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20 30Q30 25 45 30T70 30L75 35Q80 37 75 40T45 40Q30 45 20 40Z" fill="url(#fishGradient2)" stroke="#0284c7" stroke-width="1"/>
            <circle cx="30" cy="35" r="2" fill="#0284c7"/>
            <defs>
                <linearGradient id="fishGradient2" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="10%" stop-color="#0ea5e9" stop-opacity="0.8"/>
                    <stop offset="90%" stop-color="#0284c7" stop-opacity="0.3"/>
                </linearGradient>
            </defs>
        </svg>
    </div>
</div>

@if($popularArticles->count() > 0)
<div class="overflow-hidden relative py-16  shadow-inner">
    <div class="text-center mb-12 animate-on-scroll bg-gradient-to-t from-blue-100/8 blue-100/75 to-blue-100/80">
        <div class="inline-flex items-center bg-purple-100 text-cyan-700 px-6 py-2 rounded-full mb-4 font-medium shadow-lg">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
            </svg>
            <span>Artikel Populer</span>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2 slide-in-left">
            <span class="text-cyan-600">Trending</span> Di Komunitas Laut
        </h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto slide-in-right">
            Artikel yang paling banyak dibaca dan digemari
        </p>
    </div>

    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-cyan-50/30 to-transparent z-0"></div>

    <div class="absolute bottom-0 left-10 z-10 opacity-40">
        <svg width="70" height="150" viewBox="0 0 70 150" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M30 150 C40 135, 25 120, 38 105 C45 90, 20 75, 32 60 C42 45, 25 30, 38 15 C48 0, 30 -5, 35 -15"
                  stroke="#7e22ce" stroke-width="2.5" stroke-linecap="round" fill="none" class="animate-pulse-slow"/>
            <path d="M20 150 C15 130, 28 110, 15 90 C10 70, 25 50, 15 30"
                  stroke="#7e22ce" stroke-width="2" stroke-linecap="round" fill="none" class="animate-pulse-slow" style="animation-delay: 1s"/>
        </svg>
    </div>

    <div class="absolute bottom-0 right-10 z-10 opacity-40">
        <svg width="70" height="130" viewBox="0 0 70 130" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M35 130 C28 105, 42 90, 28 65 C22 40, 40 25, 28 0"
                  stroke="#7e22ce" stroke-width="2.5" stroke-linecap="round" fill="none" class="animate-pulse-slow"/>
            <path d="M50 130 C55 105, 40 90, 53 65 C58 40, 40 25, 53 0"
                  stroke="#7e22ce" stroke-width="2" stroke-linecap="round" fill="none" class="animate-pulse-slow" style="animation-delay: 0.5s"/>
        </svg>
    </div>

    <div class="flex auto-scroll-reverse py-10 relative z-10">
        @foreach($popularArticles as $index => $article)
            <div class="flex-shrink-0 w-96 h-72 mx-4 rounded-2xl overflow-hidden shadow-2xl transform transition-all duration-500 hover:scale-105 hover:-rotate-1 gallery-card group">
                <div class="relative w-full h-full perspective">
                    <div class="card-inner relative w-full h-full transition-transform duration-700 transform-style-3d group-hover:rotate-y-15">
                        @if($article->gambar)
                            <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-sky-400 to-blue-500 flex items-center justify-center">
                                <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path>
                                </svg>
                            </div>
                        @endif

                        <div class="absolute top-4 left-4 flex space-x-2">
                            <div class="flex items-center bg-black/50 backdrop-blur-sm text-white text-xs px-3 py-1 rounded-full">
                                <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7zM10 5a5 5 0 100 10 5 5 0 000-10z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $article->view_count ?? rand(120, 999) }}
                            </div>

                            <div class="flex items-center bg-black/50 backdrop-blur-sm text-white text-xs px-3 py-1 rounded-full">
                                <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $article->reactions_count ?? rand(10, 99) }}
                            </div>
                        </div>

                        <div class="absolute top-3 right-3 bg-gradient-to-r from-cyan-600 to-blue-600 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg transform -rotate-2 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                            </svg>
                            POPULAR
                        </div>

                        @if($index < 3)
                            <div class="absolute top-12 right-3 bg-gradient-to-r from-cyan-500 to-sky-400 text-white w-8 h-8 rounded-full shadow-lg flex items-center justify-center font-bold text-sm">
                                #{{ $index + 1 }}
                            </div>
                        @endif

                        <div class="absolute inset-0 bg-gradient-to-t from-sky-900/90 via-blue-800/80 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-6">
                            @if($article->category)
                                <span class="bg-cyan-500/80 backdrop-blur-sm text-white text-xs py-1 px-3 rounded-full w-fit mb-3 transform -translate-y-4 group-hover:translate-y-0 transition-all duration-500 delay-100">
                                    {{ $article->category->nama_kategori }}
                                </span>
                            @endif

                            <h3 class="text-white font-bold text-xl mb-3 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                {{ $article->judul }}
                            </h3>

                            <p class="text-purple-100 text-sm mb-4 opacity-0 group-hover:opacity-100 transition-all duration-300 delay-150 line-clamp-2">
                                {{ Str::limit(strip_tags($article->konten_isi_artikel), 80) }}
                            </p>

                            <div class="flex items-center justify-between opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-200">
                                <div class="flex items-center">
                                    @if($article->user && $article->user->profile_photo)
                                        <img src="{{ asset('storage/' . $article->user->profile_photo) }}" alt="{{ $article->user->name }}" class="w-8 h-8 rounded-full mr-2 border-2 border-white">
                                    @else
                                        <div class="w-8 h-8 bg-purple-200 text-cyan-600 rounded-full flex items-center justify-center mr-2 border-2 border-white">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <span class="text-white text-xs">{{ $article->user->name ?? 'Penulis' }}</span>
                                </div>
                                <a href="{{ route('articles.show', $article->slug) }}" class="bg-white/20 backdrop-blur-sm text-white px-4 py-1.5 rounded-full text-sm hover:bg-white/40 transition flex items-center">
                                    Baca
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <div class="absolute inset-0 bg-gradient-to-tr from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 transform rotate-15 translate-x-full group-hover:translate-x-[-60%]"></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif

<div class="flex justify-center mt-6 gap-3">
    <button class="scroll-button-left bg-white text-blue-600 rounded-full w-12 h-12 flex items-center justify-center shadow-lg hover:bg-blue-50 transition-all">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </button>
    <button class="scroll-button-right bg-white text-blue-600 rounded-full w-12 h-12 flex items-center justify-center shadow-lg hover:bg-blue-50 transition-all">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>
</div>

<div class="absolute top-1/2 right-0 transform -translate-y-1/2 z-10 opacity-30 rotate-180">
    <svg width="100" height="60" viewBox="0 0 100 60" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M20 30Q30 25 45 30T70 30L75 35Q80 37 75 40T45 40Q30 45 20 40Z" fill="url(#fishGradient2)" stroke="#0284c7" stroke-width="1"/>
        <circle cx="30" cy="35" r="2" fill="#0284c7"/>
        <defs>
            <linearGradient id="fishGradient2" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="10%" stop-color="#0ea5e9" stop-opacity="0.8"/>
                <stop offset="90%" stop-color="#0284c7" stop-opacity="0.3"/>
            </linearGradient>
        </defs>
    </svg>
</div>

    <div class="container mx-auto px-4 py-20 relative z-20 bg-gradient-to-t from-blue-100/8 blue-100/75 to-blue-100/80">
        <div class="text-center mb-16 animate-on-scroll">
            <div class="inline-flex items-center bg-cyan-100 text-cyan-700 px-6 py-2 rounded-full mb-4 font-medium">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                Artikel Kelautan Pilihan
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-cyan-800 mb-4 fade-in-scale">
                Harta Karun dari <span class="gradient-text">Kedalaman</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto fade-in-scale">
                Selami artikel-artikel menarik yang dipilih khusus dari samudera pengetahuan kami
            </p>
        </div>

        @if($latestArticles->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach($latestArticles->take(6) as $index => $article)
                <div class="group card-hover card-3d bg-white/80 backdrop-blur-sm rounded-3xl overflow-hidden shadow-xl border border-white/50 h-full flex flex-col animate-on-scroll" style="animation-delay: {{ $index * 0.2 }}s">
                    <div class="card-3d-inner">
                        <div class="relative overflow-hidden h-64">
                            @if($article->gambar)
                                <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-cyan-400 to-blue-500 flex items-center justify-center">
                                    <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path>
                                    </svg>
                                </div>
                            @endif

                            @if($article->category)
                            <div class="absolute top-4 left-4">
                                <span class="bg-blue-600/80 backdrop-blur-sm text-white text-xs px-3 py-1 rounded-full">
                                    {{ $article->category->nama_kategori }}
                                </span>
                            </div>
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        <div class="p-8 flex-grow flex flex-col">
                            <h3 class="text-xl font-bold mb-4 text-gray-800 group-hover:text-cyan-700 transition-colors line-clamp-2">
                                <a href="{{ route('articles.show', $article->slug) }}">{{ $article->judul }}</a>
                            </h3>

                            <p class="text-gray-600 mb-6 line-clamp-3 flex-grow">
                                {{ Str::limit(strip_tags($article->konten_isi_artikel), 120) }}
                            </p>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
                                <div class="flex items-center">
                                    @if($article->user && $article->user->profile_photo)
                                        <img src="{{ asset('storage/' . $article->user->profile_photo) }}" alt="{{ $article->user->name }}" class="w-10 h-10 rounded-full mr-3 object-cover">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-3">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-medium text-sm text-gray-800">{{ $article->user->name ?? 'Penulis' }}</p>
                                        <p class="text-xs text-gray-500">{{ $article->tgl_upload ? $article->tgl_upload->format('d M Y') : '' }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('articles.show', $article->slug) }}" class="text-cyan-600 hover:text-cyan-800 text-sm font-bold">
                                    Baca Selengkapnya →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </div>
        <div class="text-center animate-on-scroll">
            <a href="{{ route('articles.index') }}" class="inline-flex items-center bg-gradient-to-t from-sky-300 to-blue-300 text-white px-8 py-4 rounded-full font-bold hover:from-cyan-600 hover:to-blue-700 transition-all duration-300 shadow-xl transform hover:-translate-y-1 hover:shadow-cyan-500/25">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                Jelajahi Semua Artikel Kelautan
                <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>

    <div class="py-20 bg-gradient-to-b from-via-blue-100 to-blue-200/80 text-white relative overflow-hidden parallax">
        <div class="absolute inset-0 floating-particles"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 text-reveal text-blue-600 gradient-text">
                    Dampak <span class="gradient-text">Laut</span> <span class="text-black"> dalam Angka <span>
                </h2>
                <p class="text-xl max-w-3xl mx-auto text-reveal-delay-1 text-gray-600/90">
                    Temukan skala komunitas laut dan upaya pelestarian kelautan kami
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center p-8 bg-white/10 backdrop-blur-xl rounded-3xl border border-white/20 card-hover animate-on-scroll" data-counter-value="{{ $stats['publishedArticles'] }}">
                    <div class="w-16 h-16 mx-auto mb-4 bg-cyan-400 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-bold mb-2 text-white counter">{{ $stats['publishedArticles'] }}</h3>
                    <p class="text-gray-600 font-medium">Artikel Diterbitkan</p>
                </div>
                <div class="text-center p-8 bg-white/10 backdrop-blur-sm rounded-3xl border border-white/20 card-hover animate-on-scroll" data-counter-value="{{ $stats['activeUsers'] }}">
                    <div class="w-16 h-16 mx-auto mb-4 bg-blue-400 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-bold mb-2 text-white counter">{{ $stats['activeUsers'] }}</h3>
                    <p class="text-gray-600 font-medium">Anggota Komunitas Aktif</p>
                </div>

                <div class="text-center p-8 bg-white/10 backdrop-blur-sm rounded-3xl border border-white/20 card-hover animate-on-scroll" data-counter-value="{{ $stats['funfactCount'] }}">
                    <div class="w-16 h-16 mx-auto mb-4 bg-teal-400 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-bold mb-2 text-white counter">{{ $stats['funfactCount'] }}</h3>
                    <p class="text-gray-600 font-medium">Fakta Laut Dibagikan</p>
                </div>

                <div class="text-center p-8 bg-white/10 backdrop-blur-sm rounded-3xl border border-white/20 card-hover animate-on-scroll" data-counter-value="{{ $stats['reactionCount'] }}">
                    <div class="w-16 h-16 mx-auto mb-4 bg-purple-400 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-bold mb-2 text-white counter">{{ $stats['reactionCount'] }}</h3>
                    <p class="text-gray-600 font-medium">Aksi Konservasi</p>
                </div>
            </div>
        </div>
    </div>

    @if($funfacts->count() > 0)
    <div class="bg-gradient-to-t from-via-blue-100 to-blue-200/80 py-20 relative ">
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16 animate-on-scroll">
                <div class="inline-flex items-center bg-blue-100 text-blue-700 px-6 py-2 rounded-full mb-4 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                  </svg>
                    Funfact Ekosistem Laut
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 fade-in-scale">
                    <span class="text-blue-600">Fakta Menarik</span> Dari Dasar Laut
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto fade-in-scale">
                    Temukan rahasia menakjubkan yang tersembunyi di bawah ombak laut
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($funfacts as $index => $funfact)
                    <div class="group bg-white/70 backdrop-blur-lg rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-white/30 relative overflow-hidden animate-on-scroll" style="animation-delay: {{ $index * 0.2 }}s">
                        <div class="absolute -right-16 -top-16 w-32 h-32 bg-gradient-to-br from-blue-100/50 to-cyan-100/50 rounded-full opacity-60 group-hover:scale-150 transition-transform duration-700"></div>

                        @if($funfact->gambar)
                            <div class="absolute top-4 right-4 w-16 h-16 opacity-30 rounded-full overflow-hidden group-hover:opacity-50 transition-opacity">
                                <img src="{{ asset('storage/' . $funfact->gambar) }}" alt="" class="w-full h-full object-cover">
                            </div>
                        @endif

                        <div class="relative z-10">
                            <div class="flex items-center mb-4">
                                <span class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg">
                                    Fakta #{{ $funfact->urutan_animasi ?? $index + 1 }}
                                </span>
                            </div>

                            <h3 class="text-xl font-bold mb-4 text-gray-800 group-hover:text-blue-700 transition-colors">
                                {{ $funfact->judul }}
                            </h3>

                            <p class="text-gray-600 mb-6 leading-relaxed">
                                {{ app()->getLocale() === 'id' ? $funfact->deskripsi_id : ($funfact->deskripsi_en ?? $funfact->deskripsi_id) }}
                            </p>

                            @if($funfact->article_id)
                                <a href="{{ route('articles.show', $funfact->article->slug ?? $funfact->article_id) }}"
                                   class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold group-hover:translate-x-1 transition-all">
                                    <span>Pelajari Lebih Dalam</span>
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center">
                <a href="{{ route('funfacts.index') }}" class="inline-flex items-center px-8 py-4 bg-white border-2 border-blue-500 rounded-full text-blue-600 font-bold hover:bg-blue-50 transition-all duration-300 shadow-lg group animate-on-scroll">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <span>Temukan Lebih Banyak Fakta Menarik</span>
                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    @endif


   <div class="bg-gradient-to-b from-via-blue-100 to-blue-100 py-20 relative">
    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-cyan-50/30 to-transparent"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-16 animate-on-scroll">
            <div class="inline-flex items-center bg-gray-100 text-gray-700 px-6 py-2 rounded-full mb-4 font-medium">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                <span>Kategori</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 fade-in-scale">
                Jelajahi <span class="text-cyan-800">Berbagai Topik</span> Kelautan
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto fade-in-scale">
                Temukan artikel menarik dari berbagai kategori kelautan yang ada
            </p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6 animate-on-scroll">
            @foreach($categories as $category)
                <a href="{{ route('articles.index', ['category' => $category->category_id]) }}"
                   class="group bg-white/90 backdrop-blur-sm rounded-2xl overflow-hidden shadow-lg hover:shadow-cyan-200/50 transition-all duration-300 transform hover:-translate-y-1 flex flex-col h-full">
                    <div class="h-32 overflow-hidden relative">
                        <img src="{{ $category->image_url }}"
                             alt="{{ $category->nama_kategori }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    </div>
                    <div class="p-4 flex flex-col justify-between flex-grow">
                        <div>
                            <h3 class="font-bold text-cyan-800 mb-1 group-hover:text-cyan-600 transition-colors">
                                {{ $category->nama_kategori }}
                            </h3>
                            <p class="text-xs text-gray-600 line-clamp-2">
                                {{ $category->deskripsi }}
                            </p>
                        </div>
                        <div class="mt-3 flex justify-between items-center text-xs text-gray-500">
                            <span>{{ $category->articles->count() }} artikel</span>
                            <svg class="w-4 h-4 text-cyan-500 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>

    <div class="relative bg-gradient-to-b from-via-blue-100 to-blue-300/80 text-white py-24 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="deep-sea-bubbles absolute inset-0"></div>
            <div class="ocean-current absolute inset-0 opacity-20"></div>
        </div>

        <div class="container mx-auto px-4 text-center relative z-10">
            <div class="max-w-4xl mx-auto animate-on-scroll">
                <div class="inline-flex items-center bg-white/10 backdrop-blur-sm rounded-full px-6 py-3 mb-8">
                    <div class="w-3 h-3 bg-cyan-600 rounded-full mr-3 animate-pulse"></div>
                    <span class="text-cyan-600 font-medium">Gabung Komunitas Laut</span>
                </div>

                <h2 class="text-5xl md:text-6xl font-bold mb-6 leading-tight text-reveal text-black">
                    Jadilah
                    <span class="gradient-text text-cyan-800">Penjelajah Lautan</span>
                </h2>

                <p class="text-xl md:text-2xl mb-12 text-gray-600 max-w-3xl mx-auto leading-relaxed text-reveal-delay-1">
                    Bagikan penemuan kelautan Anda, terhubung dengan sesama penggemar laut, dan bantu menciptakan lautan pengetahuan terbesar di dunia
                </p>

                @auth
                    <div class="flex flex-col sm:flex-row gap-6 justify-center items-center text-reveal-delay-2">
                        <a href="{{ route('articles.create') }}"
                           class="group bg-white text-blue-700 px-10 py-5 rounded-full font-bold hover:bg-cyan-50 transition-all duration-300 shadow-xl transform hover:-translate-y-2 hover:shadow-cyan-500/25 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Mulai Perjalanan Laut Anda
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>

                        <a href="{{ route('articles.index') }}"
                           class="group bg-transparent border-2 border-white/50 backdrop-blur-sm px-10 py-5 rounded-full font-bold hover:bg-white hover:text-blue-700 transition-all duration-300 flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Jelajahi Kedalaman Laut
                        </a>
                    </div>
                @else
                    <div class="flex flex-col sm:flex-row gap-6 justify-center items-center text-reveal-delay-2">
                        <a href="{{ route('login') }}"
                           class="group bg-white text-blue-700 px-10 py-5 rounded-full font-bold hover:bg-cyan-50 transition-all duration-300 shadow-xl transform hover:-translate-y-2 hover:shadow-cyan-500/25 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Masuk ke Akun
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>

                        <a href="{{ route('register') }}"
                           class="group bg-transparent border-2 border-white/50 backdrop-blur-sm px-10 py-5 rounded-full font-bold hover:bg-white hover:text-blue-700 transition-all duration-300 flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            Gabung Komunitas Laut
                        </a>
                    </div>
                @endauth

                <div class="mt-16 grid grid-cols-1 sm:grid-cols-3 gap-8 max-w-2xl mx-auto text-reveal-delay-3">
                    <div class="text-center card-hover bg-white/10 rounded-xl backdrop-blur-md p-6">
                        <div class="text-3xl font-bold text-cyan-600 mb-2 counter">{{ $stats['totalUsers'] ?? ($stats['activeUsers'] * 2) }}+</div>
                        <div class="text-gray-600 text-sm">Penjelajah Laut</div>
                    </div>
                    <div class="text-center card-hover bg-white/10 rounded-xl backdrop-blur-md p-6">
                        <div class="text-3xl font-bold text-cyan-600 mb-2 counter">{{ $stats['publishedArticles'] }}+</div>
                        <div class="text-gray-600 text-sm">Artikel Dipublikasikan</div>
                    </div>
                    <div class="text-center card-hover bg-white/10 rounded-xl backdrop-blur-md p-6">
                        <div class="text-3xl font-bold text-cyan-600 mb-2 counter">{{ $categories->count() }}+</div>
                        <div class="text-gray-600 text-sm">Zona Laut</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto">
                <path fill="#f0fdff" fill-opacity="1" d="M0,224L48,208C96,192,192,160,288,160C384,160,480,192,576,213.3C672,235,768,245,864,234.7C960,224,1056,192,1152,181.3C1248,171,1344,181,1392,186.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </div>

    @endsection
 <style>

.contact-section {
  background: linear-gradient(180deg, var(--ocean-shallow) 0%, white 100%);
}

.footer-section {
  background: linear-gradient(135deg, var(--ocean-abyss) 0%, #0f172a 100%);
}

.card-ocean {
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.5);
  box-shadow: 0 4px 15px rgba(0, 131, 255, 0.1);
}

.card-ocean:hover {
  box-shadow: 0 8px 25px rgba(0, 131, 255, 0.2);
  border: 1px solid rgba(56, 189, 248, 0.3);
}

.wave-divider {
  display: block;
  width: 100%;
  height: 75px;
  mask-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z' opacity='.25' fill='%23ffffff'/%3E%3Cpath d='M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z' opacity='.5' fill='%23ffffff'/%3E%3Cpath d='M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z' fill='%23ffffff'/%3E%3C/svg%3E");
  mask-size: cover;
  mask-position: bottom;
  background: linear-gradient(90deg, var(--ocean-surface) 0%, white 100%);
  margin: -1px 0;
}

.stats-card {
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(8px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  transition: all 0.3s ease;
}

.stats-card:hover {
  background: rgba(255, 255, 255, 0.15);
  transform: translateY(-5px);
}

.gallery-card::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at top right, rgba(255,255,255,0.1), transparent 70%);
  z-index: 1;
  pointer-events: none;
}

.gallery-card {
    flex: 0 0 auto;
    width: 24rem;
    height: 18rem;
    margin: 0 1rem;
    scroll-snap-align: start;
    transform-origin: center center;
    transition: transform 0.5s ease, box-shadow 0.5s ease;
    position: relative;
    z-index: 15; 
}
.container {
    position: relative;
    z-index: 10;
}
    .light-rays {
        background: radial-gradient(ellipse at 50% -50%, rgba(255, 255, 255, 0.4) 0%, rgba(255, 255, 255, 0) 70%);
        mix-blend-mode: overlay;
        animation: lightRay 8s infinite;
    }

    .deep-sea-bubbles::before,
    .deep-sea-bubbles::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0.4;
        pointer-events: none;
    }

    @keyframes bubble-rise {
        0% { transform: translateY(120%) translateX(0) scale(0.2); opacity: 0; }
        10% { opacity: 0.8; }
        100% { transform: translateY(-100%) translateX(var(--tx, 0px)) scale(1); opacity: 0; }
    }

    @keyframes float-particle {
        0% { transform: translate(0, 0) rotate(0deg); }
        33% { transform: translate(var(--tx1, 15px), var(--ty1, 15px)) rotate(var(--tr1, 120deg)); }
        66% { transform: translate(var(--tx2, -15px), var(--ty2, -15px)) rotate(var(--tr2, 240deg)); }
        100% { transform: translate(0, 0) rotate(0deg); }
    }

    @keyframes drift-slow {
        0% { transform: translateX(0) translateY(0); }
        50% { transform: translateX(-2%) translateY(1%); }
        100% { transform: translateX(0) translateY(0); }
    }

    @keyframes pulse-slow {
        0%, 100% { opacity: 0.7; }
        50% { opacity: 0.9; }
    }

    @keyframes wave {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .animate-bubble-rise {
        animation: bubble-rise 20s ease-in infinite;
    }

    .animate-float-particle {
        animation: float-particle 20s ease-in-out infinite;
    }

    .animate-drift-slow {
        animation: drift-slow 20s ease-in-out infinite;
    }

    .animate-pulse-slow {
        animation: pulse-slow 8s ease-in-out infinite;
    }

    .animate-wave {
        animation: wave 6s ease-in-out infinite;
    }

    .floating-particles > div {
        --tx1: 15px;
        --ty1: 15px;
        --tx2: -15px;
        --ty2: -15px;
        --tr1: 120deg;
        --tr2: 240deg;
    }
     @keyframes float-bubble {
        0% {
            transform: translateY(0) translateX(0) scale(1);
            opacity: 0.1;
        }
        25% {
            opacity: 0.6;
        }
        50% {
            transform: translateY(-20px) translateX(10px) scale(1.1);
            opacity: 0.3;
        }
        75% {
            opacity: 0.7;
        }
        100% {
            transform: translateY(0) translateX(0) scale(1);
            opacity: 0.1;
        }
    }

    #popularArticlesSection {
        background-image: linear-gradient(to bottom right, rgba(139, 92, 246, 0.05), rgba(124, 58, 237, 0.1));
        border-radius: 2rem;
        margin: 1rem 0;
        padding: 1rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
    }

    #trendingArticlesSection {
        background-image: linear-gradient(to bottom right, rgba(239, 68, 68, 0.05), rgba(248, 113, 113, 0.1));
        border-radius: 2rem;
        margin: 1rem 0;
        padding: 1rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
    }


    .flex.auto-scroll, .flex.auto-scroll-reverse {
    display: flex;
    overflow-x: auto;
    padding: 1.5rem 0;
    scroll-snap-type: x mandatory;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;  
    -ms-overflow-style: none;  
}

.horizontal-scroll-container {
  position: relative;
  width: 100%;
  overflow: visible;
  padding: 2rem 0;
}


.flex.auto-scroll::-webkit-scrollbar,
.flex.auto-scroll-reverse::-webkit-scrollbar {
    display: none;  
}

.flex.auto-scroll > div,
.flex.auto-scroll-reverse > div {
   flex-shrink: 0;
    margin-bottom: 0.5rem;
  margin-top: 0.5rem;
  transform-origin: center center;
}
.scroll-button-left,
.scroll-button-right {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  z-index: 20;
}

.scroll-button-left {
  left: 0.5rem;
}

.scroll-button-right {
  right: 0.5rem;
}


</style>

<script>
       document.addEventListener('DOMContentLoaded', function() {
        const heroSection = document.querySelector('.deep-sea-bubbles');
        if (heroSection) {
            for (let i = 0; i < 30; i++) {
                createUnderwaterBubble(heroSection);
            }

            const particlesContainer = document.querySelector('.floating-particles');
            if (particlesContainer) {
                for (let i = 0; i < 15; i++) {
                    createFloatingParticle(particlesContainer);
                }
            }

            animateOceanBackground();
        }


         const scrollProgress = document.createElement('div');
     scrollProgress.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 4px;
        background: linear-gradient(90deg, #10b981, #06b6d4, #3b82f6);
        z-index: 9999;
        transition: width 0.1s ease;
    `;
    document.body.appendChild(scrollProgress);

    window.addEventListener('scroll', () => {
        const scrollable = document.documentElement.scrollHeight - window.innerHeight;
        const scrolled = window.scrollY;
        const progress = (scrolled / scrollable) * 100;
        scrollProgress.style.width = progress + '%';
    });

    });

    function animateOceanBackground() {
        const oceanBg = document.querySelector('.hero-ocean-bg');
        if (!oceanBg) {
            const heroSection = document.querySelector('.relative.overflow-hidden.min-h-screen');
            if (heroSection) {
                const oceanBgDiv = document.createElement('div');
                oceanBgDiv.className = 'hero-ocean-bg absolute inset-0 z-5';
                oceanBgDiv.innerHTML = `
                    <div class="absolute inset-0 bg-gradient-to-b from-blue-900/40 via-blue-700/30 to-teal-600/30 animate-pulse-slow"></div>
                    <div class="absolute bottom-0 left-0 right-0 h-1/2 bg-gradient-to-t from-blue-900/80 to-transparent"></div>
                    <div class="absolute inset-0 bg-[url('{{ asset('home/bawahlaut.jpg')}}'] opacity-10 mix-blend-overlay animate-drift-slow"></div>
                `;
                heroSection.prepend(oceanBgDiv);
            }
        }
    }

    function createUnderwaterBubble(parent) {
        const bubble = document.createElement('div');

        bubble.className = 'absolute rounded-full bg-white/30 pointer-events-none animate-bubble-rise';

        const size = Math.random() * 30 + 5;
        bubble.style.width = `${size}px`;
        bubble.style.height = `${size}px`;

        const left = Math.random() * 100;
        bubble.style.left = `${left}%`;
        bubble.style.bottom = '-20px';

        const duration = Math.random() * 10 + 15; 
        const delay = Math.random() * 15;
        bubble.style.animationDuration = `${duration}s`;
        bubble.style.animationDelay = `${delay}s`;

        bubble.style.background = 'radial-gradient(circle at 30% 30%, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0.2) 60%, rgba(255,255,255,0) 100%)';
        bubble.style.boxShadow = '0 0 10px rgba(255,255,255,0.3)';

        parent.appendChild(bubble);
    }

    function createFloatingParticle(parent) {
        const particle = document.createElement('div');

        particle.className = 'absolute rounded-full pointer-events-none animate-float-particle';

        const size = Math.random() * 8 + 2;
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;

        particle.style.left = `${Math.random() * 100}%`;
        particle.style.top = `${Math.random() * 100}%`;

        if (Math.random() > 0.7) {
            particle.className = 'absolute rounded-sm pointer-events-none animate-float-particle';
            particle.style.width = `${size * 2}px`;
            particle.style.height = `${size}px`;
            particle.style.transform = `rotate(${Math.random() * 360}deg)`;

            const colors = ['bg-cyan-400/20', 'bg-blue-300/20', 'bg-teal-300/20'];
            const randomColor = colors[Math.floor(Math.random() * colors.length)];
            particle.classList.add(randomColor);
        } else {
            
            const colors = ['bg-white/30', 'bg-cyan-100/20', 'bg-blue-50/20'];
            const randomColor = colors[Math.floor(Math.random() * colors.length)];
            particle.classList.add(randomColor);
        }

        const duration = Math.random() * 20 + 30;
        particle.style.animationDuration = `${duration}s`;

        parent.appendChild(particle);
    }
     document.addEventListener('DOMContentLoaded', function() {
        const sectionDivider = document.querySelector('.section-bubbles');
        if (sectionDivider) {
            for (let i = 0; i < 20; i++) {
                createSectionBubble(sectionDivider);
            }
        }
    });

    function createSectionBubble(parent) {
        const bubble = document.createElement('div');

        bubble.className = 'absolute rounded-full pointer-events-none';

        const size = Math.random() * 40 + 10;
        bubble.style.width = `${size}px`;
        bubble.style.height = `${size}px`;

        bubble.style.left = `${Math.random() * 100}%`;
        bubble.style.top = `${Math.random() * 100}%`;

        const position = Math.random();
        if (position < 0.33) {
            bubble.style.background = 'radial-gradient(circle at 30% 30%, rgba(129, 140, 248, 0.2) 0%, rgba(129, 140, 248, 0.1) 60%, rgba(129, 140, 248, 0) 100%)';
        } else if (position < 0.66) {
            bubble.style.background = 'radial-gradient(circle at 30% 30%, rgba(192, 132, 252, 0.2) 0%, rgba(192, 132, 252, 0.1) 60%, rgba(192, 132, 252, 0) 100%)';
        } else {
            bubble.style.background = 'radial-gradient(circle at 30% 30%, rgba(248, 113, 113, 0.2) 0%, rgba(248, 113, 113, 0.1) 60%, rgba(248, 113, 113, 0) 100%)';
        }

        bubble.style.border = '1px solid rgba(255, 255, 255, 0.5)';
        bubble.style.boxShadow = '0 0 8px rgba(255, 255, 255, 0.3)';

        bubble.style.animation = `float-bubble ${Math.random() * 10 + 20}s linear infinite`;
        bubble.style.animationDelay = `${Math.random() * 20}s`;

      
        parent.appendChild(bubble);
    }

document.addEventListener('DOMContentLoaded', function() {
    const leftButtons = document.querySelectorAll('.scroll-button-left');
    const rightButtons = document.querySelectorAll('.scroll-button-right');

    leftButtons.forEach(button => {
        button.addEventListener('click', function() {
            const parentContainer = this.closest('.relative');
            if (parentContainer) {
                const scrollContainer = parentContainer.querySelector('.flex');
                if (scrollContainer) {
                    scrollContainer.scrollBy({ left: -400, behavior: 'smooth' });
                }
            }
        });
    });

    rightButtons.forEach(button => {
        button.addEventListener('click', function() {
            const parentContainer = this.closest('.relative');
            if (parentContainer) {
                const scrollContainer = parentContainer.querySelector('.flex');
                if (scrollContainer) {
                    scrollContainer.scrollBy({ left: 400, behavior: 'smooth' });
                }
            }
        });
    });
});


</script>
