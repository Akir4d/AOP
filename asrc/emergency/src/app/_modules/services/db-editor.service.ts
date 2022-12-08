import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { MessagesJs, DbConfig } from '@app/_modules/dtos';
import { map } from 'rxjs';


@Injectable({
  providedIn: 'root'
})
export class DbEditorService {

  constructor(
    private http: HttpClient
  ) {}

  checks() {
    return this.http.post<MessagesJs[]>(`${document.getElementsByTagName("base")[0].dataset?.api}/login/checks`, {})
      .pipe(map(r => {
        return r.filter(e=>e.error == true);
      }));
  }

  dbinfo() {
    return this.http.get<DbConfig>(`${document.getElementsByTagName("base")[0].dataset?.api}/checks/dbConfig`, {});
  }

  dbTest(params: any) {
    return this.http.post<MessagesJs>(`${document.getElementsByTagName("base")[0].dataset?.api}/envedit/dbTest`, params);
  }

  saveDbDefault(params: any) {
    return this.http.post<MessagesJs>(`${document.getElementsByTagName("base")[0].dataset?.api}/envedit/saveDbDefault`, params);
  }

}
