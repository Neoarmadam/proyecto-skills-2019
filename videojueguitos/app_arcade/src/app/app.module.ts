import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

//Todo lo importado por el futuro Goku Calvo
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { ElFooterComponent } from './el-footer/el-footer.component';
import { SnakeGameComponent } from './snake-game/snake-game.component';
import { HeaderComponent } from './header/header.component';
import { ContactoComponent } from './contacto/contacto.component';
import { AcercadeComponent } from './acercade/acercade.component';
import { InicioComponent } from './inicio/inicio.component';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { LoginComponent } from './login/login.component';
import { MonigoteComponent } from './monigote/monigote.component';

@NgModule({
  declarations: [
    AppComponent,
    ElFooterComponent,
    SnakeGameComponent,
    HeaderComponent,
    ContactoComponent,
    AcercadeComponent,
    InicioComponent,
    LoginComponent,
    MonigoteComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})



export class AppModule { }
