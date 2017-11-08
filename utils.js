/**
* Copyright [2017] [jaiselrahman]
*
* Licensed under the Apache License, Version 2.0 (the "License");
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*
*     http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*/

function clearText() {
    document.getElementById('result').textContent='';
    document.getElementById('name1').value='';
    document.getElementById('name2').value='';
}

function onSubmit() {
    document.getElementById('flames').action = "/flames/" + document.getElementById('name1').value + "/" + document.getElementById('name2').value;
    return true;
}
