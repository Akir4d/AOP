import { Injectable} from '@angular/core';
import { Router } from '@angular/router';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { BehaviorSubject, Observable } from 'rxjs';
import { map } from 'rxjs/operators';


import { User, MessagesJs } from '@app/_modules/dtos';

@Injectable({ providedIn: 'root' })
export class AccountService {
  private userSubject: BehaviorSubject<User | null>;
  public user: Observable<User | null>;

  constructor(
    private router: Router,
    private http: HttpClient
  ) {
    this.userSubject = new BehaviorSubject(JSON.parse(localStorage.getItem('user')!));
    this.user = this.userSubject.asObservable();

  }

  public get userValue() {
    return this.userSubject.value;
  }

  login(username: string, password: string) {
    return this.http.post<User>(`${document.getElementsByTagName("base")[0].dataset?.api}/login`, { username, password })
      .pipe(map(user => {
        // store user details and jwt token in local storage to keep user logged in between page refreshes
        localStorage.setItem('user', JSON.stringify(user));
        this.userSubject.next(user);
        return user;
      }));
  }


  loginChecks() {
    return this.http.post<MessagesJs[]>(`${document.getElementsByTagName("base")[0].dataset?.api}/login/checks`, {})
      .pipe(map(r => {
        return r.filter(e=>e.error == true);
      }));
  }

  logout() {
    // remove user from local storage and set current user to null
    localStorage.removeItem('user');
    this.userSubject.next(null);
    this.router.navigate(['/login']);
  }

  update(params: any) {
    return this.http.post(`${document.getElementsByTagName("base")[0].dataset?.api}/users/adminUser`, params)
      .pipe(map(x => {
        // update local storage
        const user = { ...this.userValue, ...params };
        localStorage.setItem('user', JSON.stringify(user));
        return x;
      }));
  }

}
