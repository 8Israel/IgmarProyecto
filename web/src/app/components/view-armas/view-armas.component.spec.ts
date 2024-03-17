import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ViewArmasComponent } from './view-armas.component';

describe('ViewArmasComponent', () => {
  let component: ViewArmasComponent;
  let fixture: ComponentFixture<ViewArmasComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ViewArmasComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(ViewArmasComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
