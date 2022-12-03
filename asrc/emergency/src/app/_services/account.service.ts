import { Injectable} from '@angular/core';
import { Router } from '@angular/router';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { BehaviorSubject, Observable } from 'rxjs';
import { map } from 'rxjs/operators';


import { User } from '@app/_models';

@Injectable({ providedIn: 'root' })
export class AccountService {
  private userSubject: BehaviorSubject<User | null>;
  public user: Observable<User | null>;
  private requestOptions: any = {};

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

  ngOnInit() {
    let user: User = JSON.parse(String(localStorage.getItem('user')));

    const headers = new HttpHeaders({
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${user?.token}`
      });
      this.requestOptions = { headers: headers };
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

  logout() {
    // remove user from local storage and set current user to null
    localStorage.removeItem('user');
    this.userSubject.next(null);
    this.router.navigate(['/login']);
  }

  update(params: any) {
    this.ngOnInit();
    return this.http.post(`${document.getElementsByTagName("base")[0].dataset?.api}/users/adminUser`, params, this.requestOptions)
      .pipe(map(x => {
        // update local storage
        const user = { ...this.userValue, ...params };
        localStorage.setItem('user', JSON.stringify(user));
        return x;
      }));
  }

}
