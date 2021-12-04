Set WinScriptHost = CreateObject("WScript.Shell")
WinScriptHost.Run Chr(34) & "C:\xampp\htdocs\tpd\sync_script\clear_logs.bat" & Chr(34), 0
Set WinScriptHost = Nothing
