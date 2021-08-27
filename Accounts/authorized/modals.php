<!-- Modal for inserting data about the student and its attendance of faculty programs  -->
<div id="stuInsMdl" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Vstavljanje študenta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form id="stuInsFrm">
                    <p class="h5 px-lg-3 px-sm-1 pb-1">Osnovni podatki</p>
                    <div id="studentBasics" class="row px-lg-3 px-sm-1">
                        <div class="form-group col-lg-6 col-12">
                            <label class="w-100">Ime
                                <input id="name" class="form-control" type="text" name="name" required>
                            </label>
                        </div>
                        <div class="form-group col-lg-6 col-12">
                            <label class="w-100">Priimek
                                <input id="surname" class="form-control" type="text" name="surname" required>
                            </label>
                        </div>
                        <div class="form-group col-6">
                            <label class="w-100">E-naslov
                                <input id="email" class="form-control" type="email" name="email">
                            </label>
                        </div>
                        <div class="form-group col-6">
                            <label class="w-100">Telefon
                                <input id="telephone" class="form-control" type="text" name="telephone">
                            </label>
                        </div>
                        <p class="h6 col-12">Rojen</p>
                        <div class="form-group col-lg-6 col-12">
                            <label class="w-100">Država
                                <select id="birthCountry" class="form-control">
                                    <?php
                                    foreach ($DBC->selectCountries() as $country) {
                                    ?>
                                        <option value="<?php echo $country->getIdCountries(); ?>"><?php echo "{$country->getName()}({$country->getISO3Code()})"; ?></option>
                                    <?php
                                    } // foreach
                                    ?>
                                </select>
                            </label>
                        </div>
                        <div class="form-group col-lg-6 col-12">
                            <label class="w-100">Kraj
                                <select id="birthPostCode" class="form-control" name="id_postal_codes" required>
                                    <?php
                                    foreach ($DBC->selectCountries()[0]->getIdCountries() as $postalCode) {
                                    ?>
                                        <option value="<?php echo $postalCode->getIdPostalCodes(); ?>"><?php echo "{$postalCode->getMunicipality()}({$postalCode->getCode()})"; ?></option>
                                    <?php
                                    } // foreach
                                    ?>
                                </select>
                            </label>
                        </div>
                    </div>
                    <p class="h5 ">Podatki o prebivališču</p>
                    <div id="residences" class="px-lg-3 px-sm-2 pb-3">
                        <p class="h6"><strong>Stalno prebivališče</strong></p>
                        <div id="permanentResidence" class="row">
                            <input type="hidden" name="residences[0][status]" value="STALNO">
                            <div class="form-group col-lg-4 col-12">
                                <label class="w-100">Država
                                    <select id="permResCtry" class="form-control" data-target="permResPostCode">
                                        <?php
                                        foreach ($DBC->selectCountries() as $id_countries) {
                                        ?>
                                            <option value="<?php echo $id_countries->getIdCountries(); ?>"><?php echo "{$id_countries->getName()}({$id_countries->getISO3Code()})"; ?></option>
                                        <?php
                                        } // foreach
                                        ?>
                                    </select>
                                </label>
                            </div>
                            <div class="form-group col-lg-4 col-12">
                                <label class="w-100">Kraj
                                    <select id="permResPostCode" class="form-control" name="residences[0][id_postal_codes]" required>
                                        <?php
                                        foreach ($DBC->selectPostalCodes($DBC->selectCountries()[0]->getIdCountries()) as $postalCode) {
                                        ?>
                                            <option value="<?php echo $postalCode->getIdPostalCodes(); ?>"><?php echo "{$postalCode->getMunicipality()}({$postalCode->getCode()})"; ?></option>
                                        <?php
                                        } // foreach
                                        ?>
                                    </select>
                                </label>
                            </div>
                            <div class="form-group col-lg-4 col-12">
                                <label class="w-100">Naslov
                                    <input id="permResAddr" class="form-control" type="text" name="residences[0][address]" required>
                                </label>
                            </div>
                        </div>
                        <p class="h6"><strong>Začasna bivališča</strong></p>
                        <div class="d-flex justify-content-center col-12">
                            <img id="addTempRes" src="/eArchive/custom/img/add.png" alt="Dodaj bivališče" data-toggle="tooltip" title="Dodaj">
                        </div>
                    </div>
                    <div id="attendances" class="px-lg-3 px-sm-2 pb-3">
                        <p class="h5">Podatki o študiranju</p>
                        <p class="h6"><strong>Študijski programi</strong></p>
                        <div class="row">
                            <div class="form-group col-lg-6 col-12">
                                <label class="w-100">
                                    Fakulteta
                                    <select id="faculty" class="form-control" name="attendances[0][id_faculties]" required>
                                        <?php
                                        foreach ($faculties = $DBC->selectFaculties() as $faculty) {
                                        ?>
                                            <option value="<?php echo $faculty->getIdFaculties(); ?>"><?php echo $faculty->getName(); ?></option>
                                        <?php
                                        } // foreach
                                        ?>
                                    </select>
                                </label>
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label class="w-100">Program(polje, stopnja, trajanje)
                                    <select id="program" class="form-control" name="attendances[0][id_programs]" required>
                                        <?php
                                        foreach ($DBC->selectPrograms($DBC->selectFaculties()[0]->getIdFaculties()) as $program) {
                                        ?>
                                            <option value="<?php echo $program->getIdPrograms(); ?>"><?php echo "{$program->getName()}({$program->getField()}, {$program->getDegree()}, {$program->getDuration()})"; ?></option>
                                        <?php
                                        } // foreach
                                        ?>
                                    </select>
                                </label>
                            </div>
                            <div class="form-group col-lg-4 col-6">
                                <label class="w-100">Vpisan
                                    <input id="enrolled" class="form-control" type="date" name="attendances[0][enrolled]" required>
                                </label>
                            </div>
                            <div class="form-group col-lg-4 col-6">
                                <label class="w-100">Indeks
                                    <input id="index" class="form-control" type="text" name="attendances[0][index]" required>
                                </label>
                            </div>
                            <div class="d-flex align-items-center justify-content-center form-group col-lg-4 col-12">
                                <label class="mt-2">
                                    <input id="graduation" class="mr-2" type="checkbox" data-index="0" data-lbl-num="0">
                                    Diplomiral
                                </label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center col-12">
                            <img id="addProgAtten" src="/eArchive/custom/img/add.png" alt="Dodaj študij" data-toggle="tooltip" title="Dodaj">
                        </div>
                    </div>
                    <input class="btn btn-warning offset-lg-5 offset-3 col-lg-2 col-6 my-2" type="submit" value="Vstavi">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for viewing data regarding scientific papers of the student  -->
<div id="sciPapSelMdl" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"></div>
    </div>
</div>
<!-- Modal for inserting data concerning scientific paper and uploading its documents -->
<div class="modal fade" id="sciPapInsMdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Vstavljanje znanstvenega dela</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form id="sciPapInsFrm">
                    <input type="hidden" name="id_attendances" value="">
                    <div id="particulars" class="row">
                        <div class="form-group col-12">
                            <label class="w-100">Predmet
                                <input id="topic" class="form-control" type="text" name="topic" required>
                            </label>
                        </div>
                        <div class="form-group col-6">
                            <label class="w-100">Vrsta
                                <select id="type" class="form-control" name="type">
                                    <option value="DOKTORSKO DELO">Doktorsko delo</option>
                                    <option value="MAGISTRSKO DELO">Magistrsko delo</option>
                                    <option value="DIPLOMSKO DELO">Diplomsko delo</option>
                                    <option value="RAZISKOVALNO DELO">Raziskovalno delo</option>
                                    <option value="SEMINARSKO DELO">Seminarsko delo</option>
                                </select>
                            </label>
                        </div>
                        <div class="form-group col-6">
                            <label class="w-100">Napisano
                                <input id="written" class="form-control" type="date" name="written" required>
                            </label>
                        </div>
                    </div>
                    <div class="row">   
                        <div id="partakers" class="col-lg-6 col-12 mb-3">
                            <p class="h6"><strong>Soavtorji</strong></p>
                            <div class="d-flex justify-content-center col-12">
                                <button id="addPartaker" type="button" data-toggle="tooltip" title="Dodeli"></button>
                            </div>
                            <datalist id="studentDatalist">
                                <?php
                                // denote student as potential partaker on a scientific paper
                                foreach ($DBC->selectStudents() as $student) {
                                ?>
                                    <option value="<?php echo $student->index; ?>"><?php echo $student->fullname; ?></option>
                                <?php
                                } // foreach
                                ?>
                            </datalist>
                        </div>
                        <div id="mentors" class="col-lg-6 col-12 mb-3">
                            <p class="h6"><strong>Mentorji</strong></p>
                            <div class="d-flex justify-content-center col-12">
                                <button id="addMentor" type="button" data-toggle="tooltip" title="Dodeli"></button>
                            </div>
                        </div>
                    </div>
                    <div id="documents" class="mb-3">
                        <p class="h6"><strong>Dokumentacija</strong></p>
                        <div class="row">
                            <div class="form-group col-6">
                                <label class="w-100">Verzija
                                    <input id="version" class="form-control" type="text" name="documents[0][version]" required>
                                </label>
                            </div>
                            <div class="form-group col-6">
                                <input id="document" type="hidden" name="documents[0][name]" value="">
                                <label class="w-100 file-label">Dokument
                                    <input id="file" type="file" name="document[]" accept=".pdf" required>
                                </label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center col-12">
                            <button id="addDocument" type="button" data-toggle="tooltip" title="Dodaj"></button>
                        </div>
                    </div>
                    <input class="btn btn-warning offset-lg-5 offset-3 col-lg-2 col-6" type="submit" value="Dodaj">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for viewing graduation certificate obtained attending the program  -->
<div id="certSelMdl" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>
<!-- Modal for uploading graduation certificate and inserting data regarding its issuance and defence dates  -->
<div class="modal fade" id="certUplMdl" tabindex="-1" role="dialog" aria-labelledby="exampleModlaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Vstavljanje certifikata</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="certUplFrm">
                    <input type="hidden" name="id_attendances" value="">
                    <div class="row">
                        <div class="form-group col-12">
                            <input type="hidden" name="certificate" value="">
                            <label class="w-100 file-label">Certifikat
                                <input id="certificate" type="file" name="certificate[]" required>
                            </label>
                        </div>
                        <div class="form-group col-6">
                            <label class="w-100">Zagovarjan
                                <input id="defended" class="form-control" type="date" name="defended" required>
                            </label>
                        </div>
                        <div class="form-group col-6">
                            <label class="w-100">Izdan
                                <input id="issued" class="form-control" type="date" name="issued" required>
                            </label>
                        </div>
                    </div>
                    <input class="btn btn-warning offset-lg-5 offset-3 col-lg-2 col-6" type="submit" value="Vstavi">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for assigning account credentials to a student -->
<div class="modal fade" id="acctInsMdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ustvarjanje računa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="acctInsFrm">
                    <input type="hidden" name="id_attendances">
                    <input type="hidden" name="index">
                    <div class="form-group">
                        <label class="w-100">Geslo
                            <input id="password" class="form-control" name="pass" required>
                        </label>
                    </div>
                    <input class="btn btn-warning offset-lg-5 offset-3 col-lg-2 col-6" type="submit" value="Ustvari">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for reporting on performed operations -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportMdl" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Poročilo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>