<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <i class="fa fa-credit-card"></i>
                        Asistencias
                    </div>
                    <div class="card-body">
<!--                        <Calendar></Calendar>-->
                        <h4 class="h3">
                            {{ datenow }}
                            <span @click="activar" class="btn btn-primary"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                        </h4>

                        <form @submit.enter.prevent="asistencia">
                            <div class="form-group row">
                                <label for="asistencia" class="col-sm-2 col-form-label">Asistencia</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="asistencia" v-model="targeta" placeholder="Pasar targeta porfavor" autofocus>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-success" data-dismiss="modal"><i class="fa fa-credit-card"></i></button>
                                </div>
                                <div class="col-sm-12">
<!--                                    <button type="submit" class="btn btn-success" data-dismiss="modal"><i class="fa fa-credit-card"></i></button>-->
<!--                                    <h5 class="h5 p-2">{{ultimo.persona.nombre}} <span class="badge" :class="ultimo.tipo=='ENTRADA'?'badge-success':'badge-danger'">{{ultimo.tipo}}</span> {{ moment(ultimo.created_at).format("HH:mm") }}</h5>-->
                                    <h5 class="h5 p-2 text-center">{{ultimo.asistencia.nombre}} {{ultimo.hora}} <span class="badge" :class="ultimo.estado=='ENTRADA'?'badge-success':'badge-danger'">{{ultimo.estado}}</span></h5>
                                </div>
                            </div>
<!--                            <div class="modal-footer">-->
<!--                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash"></i> Cancelar</button>-->
<!--                                <button type="submit" class="btn btn-warning"> <i class="fa fa-edit"></i> Modificar</button>-->
<!--                            </div>-->
                        </form>
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Persona</th>
                                <th scope="col">Unidad</th>
                                <th scope="col">Targeta</th>
                                <th scope="col">Hora</th>
<!--                                <th scope="col">Estado</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(i,index) in asistencias" :key="index">
                                <th scope="row">{{index+1}}</th>
                                <td>{{i.nombre}}</td>
                                <td>{{i.unidad}}</td>
                                <td>{{i.persona.targeta}}</td>
                                <td>
                                    <div class="btn btn-group">
                                        <span class="btn btn-sm  text-white" v-for="(j,index) in i.logs " :class="j.estado=='ENTRADA'?'btn-success':'btn-danger'" :key="index">{{j.estado.slice(0,1)}}</span>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <FunctionalCalendar
                    v-model="calendarData"
                ></FunctionalCalendar>
            </div>
        </div>
    </div>
</template>

<script>


// Or just use in separate component
// export default {
//     components: {
//         Calendar,
//         DatePicker
//     }
//     ...
// }
import moment from 'moment'

    export default {
        // components: {
        //     Calendar,
        //     DatePicker
        // },
        data(){
          return{
              datenow: '',
              calendarData:{},
              asistencias:[],
              targeta:'',
              moment: moment,
              ultimo:{asistencia:{}},
              // moment:moment()


              // setInterval(self.time, 1000)
          }
        },
        mounted() {
            // this.datenow =moment().format("dddd, MMMM Do YYYY, h:mm:ss a")
            // console.log(moment().format("dddd, MMMM Do YYYY, h:mm:ss a"));
            this.misdatos();
            this.time();


        },

        methods: {
            activar(){
                $('#asistencia').focus();
            },
            asistencia(){
                axios.post('/asistencia',{targeta:this.targeta}).then(res=>{
                    // this.asistencias=res.data;

                    // console.log(res.data.length);

                    // if(res.data.persona.nombre==undefined){
                    //     this.ultimo={persona:{},tipo:'',created_at:'00:00'};
                    // }else{

                    // }
                    // if (res.data.length>0)

                    if (res.data=='Targeta no registrada a un personal'){
                        this.targeta='';
                        this.ultimo={asistencia:{nombre:'TARGETA NO ENCONTRADA'},unidad:'TARGETA NO ENCONTRADA',hora:'00:00:00',estado:'TARGETA NO ENCONTRADA'};
                    }else if(res.data=='Solo se permite 2 asistencias'){
                        this.targeta='';
                        this.ultimo={asistencia:{nombre:'Solo se permite 2 asistencias'},unidad:'Solo se permite 2 asistencias',hora:'00:00:00',estado:'Solo se permite 2 asistencias'};
                    } else{
                        this.ultimo=res.data;

                        this.targeta='';
                        this.misdatos();
                    }
                    // this.targeta='';
                }).catch(e=>{
                    this.targeta='';
                    //this.$swal('Registro','exitoso','success');
                    this.$swal({
                        title: "Error",
                        text: e.response.data.message,
                        icon: "error",
                        // timer: 1000
                    });
                    // this.targeta='';
                    // this.guar=true;
                })
            },
            time() {
                var self = this
                this.datenow = moment().format("dddd,DD  MMMM  YYYY, h:mm:ss a")
                this.calendarData=moment();
                setInterval(self.time, 1000)
            },
            misdatos(){
                axios.get('/asistencia').then(res=>{
                    this.asistencias=res.data;
                });
            }
        },
    }
</script>
