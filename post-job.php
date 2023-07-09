<?php
    require "config/database.php";
    require "includes/header.php";
    global $connection;
//    Login User Check
    if (!isset($_SESSION['logged']) && $_SESSION['auth_type'] === 'company') {
        header("Location: " . BASE_URL, true, 301);
    }


    if (isset($_POST['submit'])) {
        if (empty($_POST['job_title'])) {
            $_SESSION['error'] = "Job Title is required";
        } elseif (empty($_POST['job_region'])) {
            $_SESSION['error'] = "Job Region is required";
        } elseif (empty($_POST['job_type'])) {
            $_SESSION['error'] = "Job Type is required";
        } elseif (empty($_POST['vacancy'])) {
            $_SESSION['error'] = "Job Vacancy is required";
        } elseif (empty($_POST['experience'])) {
            $_SESSION['error'] = "Job Experience is required";
        } elseif (empty($_POST['salary'])) {
            $_SESSION['error'] = "Job Salary is required";
        } elseif (empty($_POST['gender'])) {
            $_SESSION['error'] = "Job Gender is required";
        } elseif (empty($_POST['application_deadline'])) {
            $_SESSION['error'] = "Job Deadline is required";
        } else {
            $job_title = $_POST['job_title'];
            $job_region = $_POST['job_region'];
            $job_type = $_POST['job_type'];
            $vacancy = $_POST['vacancy'];
            $experience = $_POST['experience'];
            $salary = $_POST['salary'];
            $gender = $_POST['gender'];
            $application_deadline = $_POST['application_deadline'];
            $job_description = $_POST['job_description'];
            $responsibilities = $_POST['responsibilities'];
            $education_experience = $_POST['education_experience'];
            $other_benefit = $_POST['other_benefit'];
            $company_email = $_SESSION['auth_email'];
            $company_name = $_SESSION['auth_name'];
            $company_id = $_SESSION['auth_id'];
            $company_image = $_SESSION['auth_image'] ?? null;
            $created_at = date("Y-m-d H:i:s");


            try {
                $sql = "INSERT INTO jobs (job_title, job_region, job_type, vacancy, experience, salary, gender, application_deadline, job_description, responsibilities, education_experience, other_benefit, company_email, company_name, company_id, company_image, created_at) 
                    VALUES (:job_title, :job_region, :job_type, :vacancy, :experience, :salary, :gender, :application_deadline, :job_description, :responsibilities, :education_experience, :other_benefit, :company_email, :company_name, :company_id, :company_image, :created_at)";
                $create = $connection->prepare($sql);
                $create->execute([
                    ':job_title' => $job_title,
                    ':job_region' => $job_region,
                    ':job_type' => $job_type,
                    ':vacancy' => $vacancy,
                    ':experience' => $experience,
                    ':salary' => $salary,
                    ':gender' => $gender,
                    ':application_deadline' => $application_deadline,
                    ':job_description' => $job_description,
                    ':responsibilities' => $responsibilities,
                    ':education_experience' => $education_experience,
                    ':other_benefit' => $other_benefit,
                    ':company_email' => $company_email,
                    ':company_name' => $company_name,
                    ':company_id' => $company_id,
                    ':company_image' => $company_image,
                    ':created_at' => $created_at
                ]);
                $_SESSION['success'] = "Job Post Successfully";
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('public/images/hero_1.jpg');" id="home-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1 class="text-white font-weight-bold">Post A Job</h1>
                    <div class="custom-breadcrumbs">
                        <a href="<?php echo BASE_URL ?>">Home</a> <span class="mx-2 slash">/</span>
                        <a href="#">Job</a> <span class="mx-2 slash">/</span>
                        <span class="text-white"><strong>Post a Job</strong></span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="site-section">
        <div class="container">

            <div class="row align-items-center mb-5">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2>Post A Job</h2>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row mb-5">
                <div class="col-lg-12">
                    <form class="p-4 p-md-5 border rounded" action="post-job.php" method="post" enctype="multipart/form-data">

                        <!--job details-->

                        <div class="form-group">
                            <label for="job-title">Job Title</label>
                            <input type="text" name="job_title" class="form-control" id="job-title" placeholder="Product Designer">
                        </div>


                        <div class="form-group">
                            <label for="job-region">Job Region</label>
                            <select name="job_region" class="selectpicker border rounded" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Region">
                                <option>Anywhere</option>
                                <option>San Francisco</option>
                                <option>Palo Alto</option>
                                <option>New York</option>
                                <option>Manhattan</option>
                                <option>Ontario</option>
                                <option>Toronto</option>
                                <option>Kansas</option>
                                <option>Mountain View</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="job-type">Job Type</label>
                            <select name="job_type" class="selectpicker border rounded" id="job-type" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Job Type">
                                <option>Part Time</option>
                                <option>Full Time</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="vacancy">Vacancy</label>
                            <input name="vacancy" type="text" class="form-control" id="vacancy" placeholder="e.g. New York">
                        </div>
                        <div class="form-group">
                            <label for="experience">Experience</label>
                            <select name="experience" class="selectpicker border rounded" id="experience" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Years of Experience">
                                <option>1-3 years</option>
                                <option>3-6 years</option>
                                <option>6-9 years</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="salary">Salary</label>
                            <select name="salary" class="selectpicker border rounded" id="salary" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Salary">
                                <option>$50k - $70k</option>
                                <option>$70k - $100k</option>
                                <option>$100k - $150k</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" class="selectpicker border rounded" id="gender" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Gender">
                                <option>Male</option>
                                <option>Female</option>
                                <option>Any</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="application_deadline">Application Deadline</label>
                            <input name="application_deadline" type="text" class="form-control" id="application_deadline" placeholder="e.g. 20-12-2022">
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="editor-1">Job Description</label>
                                <textarea class="editor form-control" id="editor-1" name="job_description" cols="30" rows="7" placeholder="Write Job Description..."></textarea>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="responsibilities">Responsibilities</label>
                                <textarea name="responsibilities" id="responsibilities" cols="30" rows="7" class="form-control" placeholder="Write Responsibilities..."></textarea>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="education_experience">Education & Experience</label>
                                <textarea name="education_experience" id="education_experience" cols="30" rows="7" class="form-control" placeholder="Write Education & Experience..."></textarea>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="other_benefit">Other Benefits</label>
                                <textarea name="other_benefit" id="other_benefit" cols="30" rows="7" class="form-control" placeholder="Write Other Benefits..."></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 ml-auto">
                            <div class="row">
                                <div class="col-6">
                                    <input type="submit" name="submit" class="btn btn-block btn-primary btn-md" style="margin-left: 200px;" value="Save Job">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


<?php require "includes/footer.php"; ?>