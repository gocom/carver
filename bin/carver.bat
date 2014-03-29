@ECHO OFF

REM Carver - Textpattern CMS CLI
REM https://github.com/gocom/carver
REM
REM Copyright (C) 2014 Jukka Svahn
REM
REM This file is part of Carver.
REM
REM Carver is free software; you can redistribute it and/or modify
REM it under the terms of the GNU General Public License
REM as published by the Free Software Foundation, version 2.
REM
REM Carver is distributed in the hope that it will be useful, but
REM WITHOUT ANY WARRANTY; without even the implied warranty of
REM ERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
REM GNU General Public License for more details.
REM
REM You should have received a copy of the GNU General Public License
REM along with Carver. If not, see <http://www.gnu.org/licenses/>.
REM

SET PHP_BIN=php
SET PHP_DIR=%~dp0
"%PHP_BIN%" "%PHP_DIR%\carver" %*
